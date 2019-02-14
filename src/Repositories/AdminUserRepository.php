<?php

namespace CrCms\Permission\Repositories;

class AdminUserRepository
{
    public function newModel()
    {
        $model = config('permission.user_model');

        return new $model;
    }
}