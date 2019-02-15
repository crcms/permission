<?php

namespace CrCms\Permission\Handlers\Permission;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Repositories\PermissionRepository;
use Illuminate\Contracts\Pagination\Paginator;

class ListHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return Paginator
     */
    public function handle(DataProviderContract $provider): Paginator
    {
        /* @var PermissionRepository $repository */
        $repository = $this->app->make(PermissionRepository::class);

        return $repository->allBy($provider->all());
    }
}
