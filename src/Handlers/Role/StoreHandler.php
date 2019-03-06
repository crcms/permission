<?php

namespace CrCms\Permission\Handlers\Role;

use CrCms\Permission\Models\RoleModel;
use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Permission\Repositories\RoleRepository;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;

class StoreHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return RoleModel
     */
    public function handle(DataProviderContract $provider): RoleModel
    {
        /* @var RoleRepository $repository */
        $repository = $this->app->make(RoleRepository::class);

        return $repository->create($provider->all());
    }
}
