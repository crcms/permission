<?php

namespace CrCms\Permission\Handlers\Role;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Handlers\Contracts\HandlerContract;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Models\Traits\NodesInformationTrait;
use CrCms\Permission\Models\Traits\RoleRelatedObtainTrait;
use CrCms\Permission\Repositories\RoleRepository;

class RoleFieldsListHandler extends AbstractHandler implements HandlerContract
{
    use RoleRelatedObtainTrait, NodesInformationTrait;

    /**
     * @param DataProviderContract $provider
     * @return array
     */
    public function handle(DataProviderContract $provider): array
    {
        /* @var RoleRepository $repository */
        $repository = $this->app->make(RoleRepository::class);

        $input['role'] = $provider->get('id');
        $model = $repository->single($input);

        //判断是否是超级管理员
        $boolean = $this->hasSuperRole($model);

        //获取所有字段节点信息
        $lists = $this->nodesOfFields();

        if ($boolean) {
            return $this->hasSuperRoleNodesInformation($lists);
        } else {
            $fields = $this->currentNormalRoleFields($model);

            return $this->hasNormalRoleNodesInformation($lists, $fields);
        }
    }
}