<?php

namespace CrCms\Permission\Repositories;

use CrCms\Repository\AbstractRepository;

class UserModelRepository extends AbstractRepository
{
    public function newModel()
    {
        $model = config('permission.user_model');

        return new $model;
    }
}