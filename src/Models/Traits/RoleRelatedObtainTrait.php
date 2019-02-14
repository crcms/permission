<?php

namespace CrCms\Permission\Models\Traits;

use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Repositories\Constants\CommonConstant;

trait RoleRelatedObtainTrait
{
    /**
     * 当前角色是否是超级管理员
     *
     * @param RoleModel $role
     * @return bool
     */
    public function hasSuperRole(RoleModel $role): bool
    {
        if ($role->super === CommonConstant::SUPER_YES) {
            return true;
        }

        return false;
    }

    /**
     * 当前普通角色的字段信息
     *
     * @param RoleModel $role
     * @return array
     */
    public function currentNormalRoleFields(RoleModel $role): array
    {
        $fields = $role->belongsToManyFields()->get()->map(function ($item) {
            return $item->only(['id', 'table_name', 'field_key', 'name']);
        })->toArray();

        return $fields;
    }

    /**
     * 当前普通角色的权限信息
     *
     * @param RoleModel $role
     * @return array
     */
    public function currentNormalRolePermissions(RoleModel $role): array
    {
        $permissions = $role->belongsToManyPermissions()->get()->map(function ($item) {
            return $item->only(['id', 'title', 'route']);
        })->toArray();

        return $permissions;
    }

    /**
     * 当前普通角色的菜单信息
     *
     * @param RoleModel $role
     * @return array
     */
    public function currentNormalRoleMenus(RoleModel $role): array
    {
        $menus = $role->belongsToManyMenus()->get()->map(function ($item) {
            return $item->only(['id', 'title', 'url', 'route', 'sort']);
        })->toArray();

        return $menus;
    }
}