<?php

namespace CrCms\Permission\Tasks;

use CrCms\Permission\Models\RoleModel;
use CrCms\Foundation\Tasks\AbstractTask;
use CrCms\Permission\Repositories\RoleRepository;
use CrCms\Foundation\Tasks\Contracts\TaskContract;
use CrCms\Permission\Repositories\FieldRepository;
use CrCms\Permission\Contracts\UserRoleRelationContract;

class UserFieldTask extends AbstractTask implements TaskContract
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
            return $this->app->make(FieldRepository::class)->get()->toArray();
        }

        return $repository->filterNotNormalRole($roles)->map(function (RoleModel $role) {
            return $role->belongsToManyFields()->get();
        })->flatten()->unique('id')->toArray();
    }
}
