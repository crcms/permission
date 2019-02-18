<?php

namespace CrCms\Permission\Tasks;

use CrCms\Foundation\Tasks\AbstractTask;
use CrCms\Foundation\Tasks\Contracts\TaskContract;
use CrCms\Permission\Contracts\UserRoleRelationContract;
use Illuminate\Support\Facades\Route;

class ValidateUserPermissionNodesTask extends AbstractTask implements TaskContract
{
    /**
     * @param mixed ...$params
     * @return bool
     */
    public function handle(...$params): bool
    {
        /* @var UserRoleRelationContract $user */
        $user = $params[0];

        $currentRoute = Route::currentRouteName();

        //获取当前用户的权限节点
        $permissions = $this->app->make(UserPermissionTask::class)->handle($user);

        if (!in_array($currentRoute, $permissions)) {
            return false;
        }

        return true;
    }
}