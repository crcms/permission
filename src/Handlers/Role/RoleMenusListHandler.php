<?php

namespace CrCms\Permission\Handlers\Role;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Handlers\Contracts\HandlerContract;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Repositories\RoleRepository;

class RoleMenusListHandler extends AbstractHandler implements HandlerContract
{
    /**
     * @param DataProviderContract $provider
     * @return array
     */
    public function handle(DataProviderContract $provider): array
    {
        /* @var RoleRepository $repository */
        $repository = $this->app->make(RoleRepository::class);

        $role = $repository->byIntIdOrFail($provider->get('id'));

        return $repository->roleMenus($role)->pluck('id')->toArray();
    }
}
