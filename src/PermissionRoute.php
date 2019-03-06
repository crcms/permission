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
     * @var string
     */
    protected static $namespace = 'CrCms\Permission\Http\Api\Controllers\\';

    /**
     * Menu route.
     *
     * @return void
     */
    public static function menu(): void
    {
        Route::apiResource('menus', static::$namespace.'MenuController')
            ->only(['index', 'show', 'store', 'update', 'destroy']);
    }

    /**
     * Role route.
     *
     * @return void
     */
    public static function role(): void
    {
        Route::apiResource('roles', static::$namespace.'RoleController')
            ->only(['index', 'show', 'store', 'update', 'destroy']);
    }

    /**
     * Permission Route.
     *
     * @return void
     */
    public static function permission(): void
    {
        Route::namespace(static::$namespace)->group(function () {
            Route::apiResource('permissions', 'PermissionController')
                ->only(['index', 'show', 'store', 'update', 'destroy']);
            Route::get('permission-group-lists', 'PermissionController@groupLists')
                ->name('permission-group-lists.get');
        });
    }

    /**
     * Constant route.
     *
     * @return void
     */
    public static function constant(): void
    {
        Route::get('permission-constants', static::$namespace.'ConstantController@getConstant')
            ->name('permission-constants.get');
    }

    /**
     * Role relation permission.
     *
     * @return void
     */
    public static function rolePermission(): void
    {
        Route::namespace(static::$namespace)->group(function () {
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
     * Field route.
     *
     * @return void
     */
    public static function field(): void
    {
        Route::apiResource('fields', static::$namespace.'FieldController')
            ->only(['index', 'show', 'store', 'update', 'destroy']);
    }

    /**
     * All route.
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
