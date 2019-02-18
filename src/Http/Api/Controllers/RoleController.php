<?php

namespace CrCms\Permission\Http\Api\Controllers;

use CrCms\Foundation\Helpers\InstanceConcern;
use CrCms\Foundation\Services\ResponseTrait;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Handlers\Role\DestroyHandler;
use CrCms\Permission\Handlers\Role\ListHandler;
use CrCms\Permission\Handlers\Role\RoleFieldsListHandler;
use CrCms\Permission\Handlers\Role\RoleFieldsUpdateHandler;
use CrCms\Permission\Handlers\Role\RoleMenusListHandler;
use CrCms\Permission\Handlers\Role\RoleMenusUpdateHandler;
use CrCms\Permission\Handlers\Role\RolePermissionsListHandler;
use CrCms\Permission\Handlers\Role\RolePermissionUpdateHandler;
use CrCms\Permission\Handlers\Role\ShowHandler;
use CrCms\Permission\Handlers\Role\StoreHandler;
use CrCms\Permission\Handlers\Role\UpdateHandler;
use CrCms\Permission\Http\Api\Resources\RoleResource;
use CrCms\Permission\Http\DataProviders\Role\RoleFieldsUpdateDataProvider;
use CrCms\Permission\Http\DataProviders\Role\RoleMenusUpdateDataProvider;
use CrCms\Permission\Http\DataProviders\Role\RolePermissionUpdateDataProvider;
use CrCms\Permission\Http\DataProviders\Role\StoreDataProvider;
use CrCms\Permission\Http\DataProviders\Role\UpdateDataProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class RoleController extends Controller
{
    use ResponseTrait, InstanceConcern;

    /**
     * @param DataProviderContract $provider
     * @return JsonResponse
     * @throws \Exception
     */
    public function index(DataProviderContract $provider): JsonResponse
    {
        return $this->response()->paginator(
            $this->app->make(ListHandler::class)->handle($provider),
            $this->config->get('permission.resources.role', RoleResource::class)
        );
    }

    /**
     * @param DataProviderContract $provider
     * @return JsonResponse
     * @throws \Exception
     */
    public function show(DataProviderContract $provider)
    {
        return $this->response()->resource(
            $this->app->make(ShowHandler::class)->handle($provider),
            $this->config->get('permission.resources.role', RoleResource::class)
        );
    }

    /**
     * @param StoreDataProvider $request
     * @return JsonResponse
     */
    public function store(StoreDataProvider $request)
    {
        return $this->response()->resource(
            $this->app->make(StoreHandler::class)->handle($request),
            $this->config->get('permission.resources.role', RoleResource::class)
        );
    }

    /**
     * @param UpdateDataProvider $request
     * @return JsonResponse
     */
    public function update(UpdateDataProvider $request)
    {
        return $this->response()->resource(
            $this->app->make(UpdateHandler::class)->handle($request),
            $this->config->get('permission.resources.role', RoleResource::class)
        );
    }

    /**
     * @param DataProviderContract $provider
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DataProviderContract $provider)
    {
        $this->app->make(DestroyHandler::class)->handle($provider);

        return $this->response()->noContent();
    }

    /**
     * @param RolePermissionUpdateDataProvider $request
     * @return JsonResponse
     */
    public function rolePermissionUpdate(RolePermissionUpdateDataProvider $request)
    {
        return $this->response()->resource(
            $this->app->make(RolePermissionUpdateHandler::class)->handle($request),
            $this->config->get('permission.resources.role', RoleResource::class)
        );
    }

    /**
     * @param DataProviderContract $provider
     * @return JsonResponse|\Illuminate\Http\Response
     */
    public function rolePermissionsList(DataProviderContract $provider)
    {
        return $this->response()->data(
            $this->app->make(RolePermissionsListHandler::class)->handle($provider)
        );
    }

    /**
     * @param RoleMenusUpdateDataProvider $request
     * @return JsonResponse
     */
    public function roleMenusUpdate(RoleMenusUpdateDataProvider $request)
    {
        return $this->response()->resource(
            $this->app->make(RoleMenusUpdateHandler::class)->handle($request),
            $this->config->get('permission.resources.role', RoleResource::class)
        );
    }

    /**
     * @param DataProviderContract $provider
     * @return JsonResponse|\Illuminate\Http\Response
     */
    public function roleMenusList(DataProviderContract $provider)
    {
        return $this->response()->data(
            $this->app->make(RoleMenusListHandler::class)->handle($provider)
        );
    }

    /**
     * @param RoleFieldsUpdateDataProvider $request
     * @return JsonResponse
     */
    public function roleFieldsUpdate(RoleFieldsUpdateDataProvider $request)
    {
        return $this->response()->resource(
            $this->app->make(RoleFieldsUpdateHandler::class)->handle($request),
            $this->config->get('permission.resources.role', RoleResource::class)
        );
    }

    /**
     * @param DataProviderContract $provider
     * @return JsonResponse|\Illuminate\Http\Response
     */
    public function roleFieldsList(DataProviderContract $provider)
    {
        return $this->response()->data(
            $this->app->make(RoleFieldsListHandler::class)->handle($provider)
        );
    }
}
