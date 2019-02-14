<?php

namespace CrCms\Permission\Models\Traits;

use CrCms\Permission\Models\FieldModel;
use CrCms\Permission\Models\MenuModel;
use CrCms\Permission\Models\PermissionModel;
use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use Illuminate\Support\Collection;

trait NodesInformationTrait
{
    /**
     * 所有角色节点信息
     *
     * @return array
     */
    public function nodesOfRoles(): array
    {
        $model = new RoleModel();

        return $model->where('status', CommonConstant::STATUS_NORMAL)
            ->get()->map(function ($item) {
                return $item->only(['id', 'name', 'remark']);
            })->toArray();
    }

    /**
     * 所有字段节点信息
     *
     * @return array
     */
    public function nodesOfFields(): array
    {
        $model = new FieldModel();

        return $model->all()->map(function ($item) {
            if (!$item->name) {
                $item->name = $item->table_name.'.'.$item->field_key;
            }
            return $item->only(['id', 'table_name', 'field_key', 'name']);
        })->toArray();
    }

    /**
     * 所有权限节点信息
     *
     * @return array
     */
    public function nodesOfPermissions(): array
    {
        $model = new PermissionModel();

        return $model->all()->filter(function($item) {
            return $item->status === CommonConstant::STATUS_NORMAL;
        })->map(function ($item) {
            return $item->only(['id', 'title', 'route']);
        })->toArray();
    }

    /**
     * 所有无限极分类菜单节点信息
     *
     * @return array
     */
    public function nodesOfMenus(): array
    {
        $model = new MenuModel();

        $lists = $model->where('status', CommonConstant::STATUS_NORMAL)
            ->orderBy('sort', 'desc')->get()->map(function ($item) {
                return $item->only(['id', 'title', 'route', 'icon', 'url', 'pid']);
            });

        return array_values($this->tree($lists));
    }

    /**
     * 超级管理员角色节点信息
     *
     * @param array $nodes 所有节点
     * @return array
     */
    public function hasSuperRoleNodesInformation(array $nodes): array
    {
        $data = [];

        if (empty($nodes)) {
            return $data;
        }

        foreach ($nodes as $key => $val) {
            $data[$key] = $val;
            $data[$key]['valid'] = 1;
        }

        return $data;
    }

    /**
     * 普通角色节点信息
     *
     * @param array $nodes 所有节点
     * @param array $own 已拥有节点
     * @return array
     */
    public function hasNormalRoleNodesInformation(array $nodes, array $own = []): array
    {
        $data = [];

        if (empty($nodes)) {
            return $data;
        }

        $ids = array_column($own, 'id');

        foreach ($nodes as $key => $val) {
            $data[$key] = $val;

            if (in_array($val['id'], $ids)) {
                $data[$key]['valid'] = 1;
            } else {
                $data[$key]['valid'] = 0;
            }
        }

        return $data;
    }

    /**
     * 无限分类
     * @param Collection $collection
     * @param int $pid
     * @param string $field
     * @param array $data
     * @return array
     */
    protected function tree(Collection $collection, $pid = 0, $field = 'pid', $data = []): array
    {
        if ($collection->isEmpty()) {
            return [];
        }

        $array = $collection->toArray();

        foreach ($array as $key => $value) {
            if ($value[$field] == $pid) {
                $data[$key] = $value;
                $tmp = $this->tree($collection, $value['id'], $field, $data);

                if (!empty($tmp)) {
                    foreach ($tmp as $k => $v) {
                        $data[$k] = $v;
                    }
                }
            }

        }

        return $data;
    }
}