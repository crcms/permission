<?php

namespace CrCms\Permission\Handlers\AdminUser;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Models\Model;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Contracts\UserRoleBindContract;

class AdminUserRolesUpdateHandler extends AbstractHandler implements UserRoleBindContract
{
    public function handle(DataProviderContract $provider)
    {
        $repository = $this->app->make();
    }

    public function userAttachRoles(Model $model, array $roleIds)
    {
        // TODO: Implement userAttachRoles() method.
    }

    public function userDetachRoles(Model $model, array $roleIds)
    {
        // TODO: Implement userDetachRoles() method.
    }
}