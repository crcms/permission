<?php

namespace CrCms\Permission\Handlers\Role;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Repositories\RoleRepository;

class ShowHandler extends AbstractHandler
{

    public function handle(DataProviderContract $provider): RoleModel
    {
        /* @var RoleRepository $repository*/
        $repository = $this->app->make(RoleRepository::class);

        return $repository->single($provider->all());
    }
}