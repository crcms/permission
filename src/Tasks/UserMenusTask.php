<?php

namespace CrCms\Permission\Tasks;

use CrCms\Permission\Models\RoleModel;
use CrCms\Foundation\Tasks\AbstractTask;
use CrCms\Permission\Repositories\MenuRepository;
use CrCms\Permission\Repositories\RoleRepository;
use CrCms\Foundation\Tasks\Contracts\TaskContract;
use CrCms\Permission\Contracts\UserRoleRelationContract;

class UserMenusTask extends AbstractTask implements TaskContract
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

        /* @var MenuRepository $menuRepository */
        $menuRepository = $this->app->make(MenuRepository::class);

        $roles = $user->belongsToManyRoles()->get();

        if ($repository->containsSuperRole($roles)) {
            return $menuRepository->allByStatusNormal()->toArray();
        }

        return $repository->filterNotNormalRole($roles)->map(function (RoleModel $role) use ($menuRepository) {
            return $menuRepository->allByRole($role);
        })->flatten(1)->unique('id')->toArray();
    }
}
