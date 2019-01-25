<?php

namespace CrCms\Permission\Handlers\Role;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Repositories\RoleRepository;

class RolePermissionUpdateHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return RoleModel
     */
    public function handle(DataProviderContract $provider): RoleModel
    {
        /* @var RoleRepository $repository */
        $repository = $this->app->make(RoleRepository::class);

        $input['role'] = $provider->get('id');
        $model = $repository->single($input);

        //获取角色权限的权限id
        $permissionIds = $model->belongsToManyPermissions()->pluck('id')->toArray();

        //若当前角色有权限-则移除旧的权限
        if (!empty($permissionIds)) {
            $model->belongsToManyPermissions()->detach($permissionIds);
        }

        $model->belongsToManyPermissions()->attach($provider->get('permission'));

        return $model;
    }
}