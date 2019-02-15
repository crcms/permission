<?php

namespace CrCms\Permission\Tasks;

use CrCms\Foundation\Tasks\AbstractTask;
use CrCms\Foundation\Tasks\Contracts\TaskContract;
use CrCms\Permission\Contracts\UserRoleRelationContract;
use CrCms\Permission\Models\PermissionModel;
use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use CrCms\Permission\Repositories\PermissionRepository;
use CrCms\Permission\Repositories\RoleRepository;

class UserPermissionTask extends AbstractTask implements TaskContract
{
    /**
     * @param mixed ...$params
     * @return array
     */
    public function handle(...$params): array
    {
        /* @var UserRoleRelationContract $user */
        $user = $params[0];
        /* @var RoleRepository $repository */
        $repository = $this->app->make(RoleRepository::class);

        $roles = $user->belongsToManyRoles()->get();

        if ($repository->containsSuperRole($roles)) {
            return $this->app->make(PermissionRepository::class)->all()->pluck('route')->toArray();
        }

        return $repository->filterNotNormalRole($roles)->map(function(RoleModel $role){
            return $role->belongsToManyPermissions()->get();
        })->flatten()->filter(function (PermissionModel $permission) {
            return $permission->status === CommonConstant::STATUS_NORMAL;
        })->unique('route')->pluck('route')->toArray();
    }
}
