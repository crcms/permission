<?php

namespace CrCms\Permission\Handlers\Role;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Repositories\RoleRepository;

class RoleFieldsUpdateHandler extends AbstractHandler
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

        //获取角色权限的字段id
        $fieldIds = $model->belongsToManyFields()->pluck('id')->toArray();

        if (!empty($fieldIds)) {
            $model->belongsToManyFields()->detach($fieldIds);
        }

        $model->belongsToManyFields()->attach($provider->get('field'));

        return $model;
    }
}