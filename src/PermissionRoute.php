<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2019-02-25 10:50
 *
 * @link http://crcms.cn/
 *
 * @copyright Copyright &copy; 2019 Rights Reserved CRCMS
 */

namespace CrCms\Permission;

use Illuminate\Support\Facades\Route;

class PermissionRoute
{
    /**
     * Menu route
     *
     * @return void
     */
    public static function menu(): void
    {
        Route::namespace('CrCms\Permission\Http\Api\Controllers')
            ->apiResource('menus', 'MenuController')
            ->only(['index', 'show', 'store', 'update', 'destroy']);
    }

    /**
     * Role route
     *
     * @return void
     */
    public static function role(): void
    {
        Route::namespace('CrCms\Permission\Http\Api\Controllers')
            ->apiResource('menus', 'RoleController')
            ->only(['index', 'show', 'store', 'update', 'destroy']);
    }

    /**
     * Permission Route
     *
     * @return void
     */
    public static function permission(): void
    {
        Route::namespace('CrCms\Permission\Http\Api\Controllers',function(){
            Route::apiResource('menus', 'PermissionController')
                ->only(['index', 'show', 'store', 'update', 'destroy']);
            Route::get('permission-group-lists', 'PermissionController@groupLists')
                ->name('permission-group-lists.get');
        });
    }

    /**
     * Constant route
     *
     * @return void
     */
    public static function constant(): void
    {
        Route::namespace('CrCms\Permission\Http\Api\Controllers')
            ->get('menus', 'ConstantController@getConstant')
            ->name('permission-constants.get');
    }

    /**
     * Role relation permission
     *
     * @return void
     */
    public static function rolePermission(): void
    {
        Route::namespace('CrCms\Permission\Http\Api\Controllers')->group(function () {
            Route::post('role-permissions', 'RoleController@rolePermissionUpdate')
                ->name('role-permissions.post');
            Route::get('role-permissions/{id}', 'RoleController@rolePermissionsList')
                ->name('role-permissions.get');


            Route::post('role-menus', 'RoleController@roleMenusUpdate')
                ->name('role-menus.post');
            Route::get('role-menus/{id}', 'RoleController@roleMenusList')
                ->name('role-menus.get');

            Route::post('role-fields', 'RoleController@roleFieldsUpdate')
                ->name('role-fields.post');
            Route::get('role-fields/{id}', 'RoleController@roleFieldsList')
                ->name('role-fields.get');
        });
    }

    /**
     * Field route
     *
     * @return void
     */
    public static function field(): void
    {
        Route::namespace('CrCms\Permission\Http\Api\Controllers')
            ->apiResource('fields', 'FieldController')
            ->only(['index', 'show', 'store', 'update', 'destroy']);
    }

    /**
     * All route
     *
     * @return void
     */
    public static function all(): void
    {
        static::constant();
        static::field();
        static::permission();
        static::role();
        static::rolePermission();
        static::menu();
    }
}