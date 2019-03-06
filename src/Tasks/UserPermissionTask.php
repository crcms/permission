<?php

namespace CrCms\Permission\Tasks;

use CrCms\Permission\Models\RoleModel;
use CrCms\Foundation\Tasks\AbstractTask;
use CrCms\Permission\Repositories\RoleRepository;
use CrCms\Foundation\Tasks\Contracts\TaskContract;
use CrCms\Permission\Repositories\PermissionRepository;
use CrCms\Permission\Contracts\UserRoleRelationContract;

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
        /* @var PermissionRepository $permissionRepository */
        $permissionRepository = $this->app->make(PermissionRepository::class);

        $roles = $user->belongsToManyRoles()->get();

        if ($repository->containsSuperRole($roles)) {
            return $permissionRepository->allByStatusNormal()->pluck('route')->toArray();
        }

        return $repository->filterNotNormalRole($roles)->map(function (RoleModel $role) use ($permissionRepository) {
            return $permissionRepository->allByRole($role);
        })->flatten()->unique('route')->pluck('route')->toArray();
    }
}
