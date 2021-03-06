<?php

namespace CrCms\Permission\Handlers\Permission;

use CrCms\Foundation\Handlers\AbstractHandler;
use Illuminate\Contracts\Pagination\Paginator;
use CrCms\Permission\Repositories\PermissionRepository;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;

class ListHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return Paginator
     */
    public function handle(DataProviderContract $provider)
    {
        /* @var PermissionRepository $repository */
        $repository = $this->app->make(PermissionRepository::class);

        return $repository->allBy($provider->all());
    }
}
