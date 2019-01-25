<?php

namespace CrCms\Permission\Handlers\Role;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Repositories\RoleRepository;

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

        $input['role'] = $provider->get('id');
        $model = $repository->single($input);

        //获取角色权限的菜单id
        $menuIds = $model->belongsToManyMenus()->pluck('id')->toArray();

        if (!empty($menuIds)) {
            $model->belongsToManyMenus()->detach($menuIds);
        }

        $model->belongsToManyMenus()->attach($provider->get('menu'));

        return $model;
    }
}