<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('api')->group(function () {
    //权限
    Route::namespace('CrCms\Permission\Http\Api\Controllers')->group(function () {
        //菜单
        Route::apiResource('menus', 'MenuController')
            ->only(['index', 'show', 'store', 'update', 'destroy']);
        //菜单搜索接口
        Route::get('menu-lists', 'MenuController@getList')->name('menu-lists.get');

        //角色
        Route::apiResource('roles', 'RoleController')
            ->only(['index', 'show', 'store', 'update', 'destroy']);

        //权限
        Route::apiResource('permissions', 'PermissionController')
            ->only(['index', 'show', 'store', 'update', 'destroy']);

        //角色权限更新
        Route::post('role-permissions', 'RoleController@rolePermissionUpdate')
            ->name('role-permissions.post');

        //角色菜单更新
        Route::post('role-menus', 'RoleController@roleMenusUpdate')
            ->name('role-menus.post');

        //角色字段更新
        Route::post('role-fields', 'RoleController@roleFieldsUpdate')
            ->name('role-fields.post');

        //字段
        Route::apiResource('fields', 'FieldController')
            ->only(['index', 'show', 'store', 'update', 'destroy']);

    });
});
