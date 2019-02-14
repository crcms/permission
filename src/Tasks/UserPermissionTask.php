<?php

namespace CrCms\Permission\Tasks;

use CrCms\Foundation\Tasks\AbstractTask;
use CrCms\Foundation\Tasks\Contracts\TaskContract;
use CrCms\Permission\Contracts\UserRoleRelationContract;
use CrCms\Permission\Models\PermissionModel;
use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use Illuminate\Support\Collection;

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

        $roles = $user->belongsToManyRoles()->get();

        if ($this->isSuperRole($roles)) {

        }

        $roles->map(function (RoleModel $role) {
            return $role->belongsToManyPermissions()->get();
        })->flatten()->filter(function (PermissionModel $permission) {
            return $permission->status === CommonConstant::STATUS_NORMAL;
        })->map(function (PermissionModel $permission) {
            return $permission->only(['id', 'title', 'route']);
        })->unique('id')->toArray();
    }

    /**
     * @param Collection $roles
     * @return bool
     */
    protected function isSuperRole(Collection $roles): bool
    {
        return $roles->filter(function (RoleModel $role) {
            return $role->super === CommonConstant::SUPER_YES;
        })->isNotEmpty();
    }
}