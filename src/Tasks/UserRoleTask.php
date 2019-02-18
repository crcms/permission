<?php

namespace CrCms\Permission\Tasks;

use CrCms\Foundation\Tasks\AbstractTask;
use CrCms\Foundation\Tasks\Contracts\TaskContract;
use CrCms\Permission\Contracts\UserRoleRelationContract;
use CrCms\Permission\Repositories\RoleRepository;

class UserRoleTask extends AbstractTask implements TaskContract
{
    /**
     * @param mixed ...$params
     * @return array
     */
    public function handle(...$params): array
    {
        /* @var UserRoleRelationContract $user*/
        $user = $params[0];

        /* @var RoleRepository $repository */
        $repository = $this->app->make(RoleRepository::class);

        $roles = $user->belongsToManyRoles()->get();

        if ($repository->containsSuperRole($roles)) {
            return $repository->allByStatusNormal()->pluck('id')->toArray();
        }

        return $repository->filterNotNormalRole($roles)->unique('id')->pluck('id')->toArray();
    }
}