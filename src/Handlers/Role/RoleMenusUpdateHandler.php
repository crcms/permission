<?php

namespace CrCms\Permission\Handlers\Role;

use CrCms\Permission\Models\RoleModel;
use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Permission\Repositories\RoleRepository;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;

class RoleMenusUpdateHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return RoleModel
     */
    public function handle(DataProviderContract $provider): RoleModel
    {
        /* @var RoleRepository $repository */
        $repository = $this->app->make(RoleRepository::class);

        $role = $repository->byIntIdOrFail($provider->get('id'));

        $repository->syncRoleMenus($role, $provider->get('menu'));

        return $role;
    }
}
