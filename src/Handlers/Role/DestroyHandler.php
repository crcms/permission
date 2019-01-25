<?php

namespace CrCms\Permission\Handlers\Role;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Repositories\RoleRepository;

class DestroyHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return int
     */
    public function handle(DataProviderContract $provider): int
    {
        /* @var RoleRepository $repository */
        $repository = $this->app->make(RoleRepository::class);

        return $repository->delete($provider->get('role'));
    }
}