<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    //权限
    Route::namespace('CrCms\Permission\Http\Api\Controllers')->group(function () {
        //菜单
        Route::apiResource('menus', 'MenuController')
            ->only(['index', 'show', 'store', 'update', 'destroy']);

        //角色
        Route::apiResource('roles', 'RoleController')
            ->only(['index', 'show', 'store', 'update', 'destroy']);

        //权限
        Route::apiResource('permissions', 'PermissionController')
            ->only(['index', 'show', 'store', 'update', 'destroy']);

        //角色权限更新
        Route::post('role-permissions', 'RoleController@rolePermissionUpdate')
            ->name('role-permissions.post');

        //当前某个角色权限列表
        Route::get('role-permissions/{id}', 'RoleController@rolePermissionsList')
            ->name('role-permissions.get');

        //角色菜单更新
        Route::post('role-menus', 'RoleController@roleMenusUpdate')
            ->name('role-menus.post');

        //当前某个角色菜单列表
        Route::get('role-menus/{id}', 'RoleController@roleMenusList')
            ->name('role-menus.get');

        //角色字段更新
        Route::post('role-fields', 'RoleController@roleFieldsUpdate')
            ->name('role-fields.post');

        //当前某个角色的字段列表
        Route::get('role-fields/{id}', 'RoleController@roleFieldsList')
            ->name('role-fields.get');

        //字段
        Route::apiResource('fields', 'FieldController')
            ->only(['index', 'show', 'store', 'update', 'destroy']);

        //常量
        Route::get('permission-constants', 'ConstantController@getConstant')
            ->name('permission-constants.get');
    });
});
