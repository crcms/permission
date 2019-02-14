<?php

namespace CrCms\Permission\Models\Traits;

use CrCms\Permission\Contracts\UserRoleRelationContract;
use CrCms\Permission\Models\FieldModel;
use CrCms\Permission\Models\MenuModel;
use CrCms\Permission\Models\PermissionModel;
use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use Illuminate\Database\Eloquent\Collection;

trait UserRelatedObtainTrait
{
    /**
     * 获取用户角色集合
     *
     * @param UserRoleRelationContract $model
     * @return Collection
     */
    protected function getRoles(UserRoleRelationContract $model): Collection
    {
        return $model->belongsToManyRoles()->get();
    }

    /**
     * 是否有超级管理员角色
     *
     * @param UserRoleRelationContract $model
     * @return bool
     */
    public function hasSuperRoles(UserRoleRelationContract $model): bool
    {
        $roles = $this->getRoles($model);

        $collections = $roles->filter(function (RoleModel $role) {
            return $role->super === CommonConstant::SUPER_YES;
        });

        //判断是否有管理员
        if ($collections->isEmpty()) {
            return false;
        }

        return true;
    }

    /**
     * 获取当前用户的角色信息
     *
     * @param UserRoleRelationContract $model
     * @return array
     */
    public function userRolesRelations(UserRoleRelationContract $model)
    {
        $roles = $this->getRoles($model);

        return $roles->filter(function ($item) {
            return $item->status === CommonConstant::STATUS_NORMAL;
        })->map(function ($item) {
            return $item->only(['id', 'name', 'remark']);
        })->toArray();
    }

    /**
     * 获取当前普通用户角色的字段信息
     *
     * @param UserRoleRelationContract $model
     * @return array
     */
    public function userHasNormalFieldsRelations(UserRoleRelationContract $model)
    {
        $roles = $this->getRoles($model);

        $fields = $roles->map(function(RoleModel $role){
            return $role->belongsToManyFields()->get();
        })->flatten()->map(function (FieldModel $field) {
            if (!$field->name) {
                $field->name = $field->table_name.'.'.$field->field_key;
            }
            return $field->only(['id', 'table_name', 'field_key', 'name']);
        })->unique('id')->toArray();

        return $fields;

    }

    /**
     * 获取当前普通用户角色菜单信息
     *
     * @param UserRoleRelationContract $model
     * @return array
     */
    public function userHasNormalMenusRelations(UserRoleRelationContract $model)
    {
        $roles = $this->getRoles($model);

        $menus = $roles->map(function (RoleModel $role) {
            return $role->belongsToManyMenus()->get();
        })->flatten()->filter(function (MenuModel $menu) {
            return $menu->status === CommonConstant::STATUS_NORMAL;
        })->map(function (MenuModel $menu) {
            return $menu->only(['id', 'title', 'url', 'route', 'icon', 'pid']);
        })->unique('id')->toArray();

        return $menus;
    }

    /**
     * 获取当前普通用户角色权限信息
     *
     * @param UserRoleRelationContract $model
     * @return array
     */
    public function userHasNormalPermissionsRelations(UserRoleRelationContract $model): array
    {
        $roles = $this->getRoles($model);

        $permissions = $roles->map(function (RoleModel $role) {
            return $role->belongsToManyPermissions()->get();
        })->flatten()->filter(function (PermissionModel $permission) {
            return $permission->status === CommonConstant::STATUS_NORMAL;
        })->map(function (PermissionModel $permission) {
            return $permission->only(['id', 'title', 'route']);
        })->unique('id')->toArray();

        return $permissions;
    }
}