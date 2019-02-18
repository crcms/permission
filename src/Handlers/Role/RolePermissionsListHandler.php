<?php

namespace CrCms\Permission\Handlers\Role;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Handlers\Contracts\HandlerContract;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Repositories\RoleRepository;

class RolePermissionsListHandler extends AbstractHandler implements HandlerContract
{
    /**
     * @param DataProviderContract $provider
     * @return array
     */
    public function handle(DataProviderContract $provider)
    {
        /* @var RoleRepository $repository */
        $repository = $this->app->make(RoleRepository::class);

        $role = $repository->byIntIdOrFail($provider->get('id'));

        return $repository->rolePermissions($role)->pluck('id')->toArray();
    }
}
