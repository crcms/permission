<?php

namespace CrCms\Permission\Handlers\Role;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Repositories\RoleRepository;

class UpdateHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return RoleModel
     */
    public function handle(DataProviderContract $provider): RoleModel
    {
        /* @var RoleRepository $repository */
        $repository = $this->app->make(RoleRepository::class);

        //整合数据
        $id = $provider->get('role');
        $input = $provider->all();

        $guard = ['name', 'status', 'super', 'remark'];

        return $repository->setGuard($guard)->update($input, $id);
    }
}