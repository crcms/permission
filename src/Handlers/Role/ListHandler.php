<?php

namespace CrCms\Permission\Handlers\Role;

use CrCms\Foundation\Handlers\AbstractHandler;
use Illuminate\Contracts\Pagination\Paginator;
use CrCms\Permission\Repositories\RoleRepository;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;

class ListHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return Paginator
     */
    public function handle(DataProviderContract $provider): Paginator
    {
        /* @var RoleRepository $repository */
        $repository = $this->app->make(RoleRepository::class);

        return $repository->paginate($provider->all());
    }
}
