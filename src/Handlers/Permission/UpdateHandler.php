<?php

namespace CrCms\Permission\Handlers\Permission;

use CrCms\Permission\Models\PermissionModel;
use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Permission\Repositories\PermissionRepository;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;

class UpdateHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return PermissionModel
     */
    public function handle(DataProviderContract $provider): PermissionModel
    {
        /* @var PermissionRepository $repository */
        $repository = $this->app->make(PermissionRepository::class);

        return $repository->update($provider->all(), $provider->get('permission'));
    }
}
