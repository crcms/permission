<?php

namespace CrCms\Permission\Handlers\Permission;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Permission\Repositories\PermissionRepository;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;

class DestroyHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return int
     */
    public function handle(DataProviderContract $provider): int
    {
        /* @var PermissionRepository $repository */
        $repository = $this->app->make(PermissionRepository::class);

        return $repository->delete($provider->get('permission'));
    }
}
