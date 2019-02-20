<?php

namespace CrCms\Permission\Http\Api\Controllers;

use CrCms\Foundation\Helpers\InstanceConcern;
use CrCms\Foundation\Services\ResponseTrait;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Handlers\Permission\DestroyHandler;
use CrCms\Permission\Handlers\Permission\GroupListHandler;
use CrCms\Permission\Handlers\Permission\ListHandler;
use CrCms\Permission\Handlers\Permission\ShowHandler;
use CrCms\Permission\Handlers\Permission\StoreHandler;
use CrCms\Permission\Handlers\Permission\UpdateHandler;
use CrCms\Permission\Http\Api\Resources\PermissionResource;
use CrCms\Permission\Http\DataProviders\Permission\StoreDataProvider;
use CrCms\Permission\Http\DataProviders\Permission\UpdateDataProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class PermissionController extends Controller
{
    use ResponseTrait, InstanceConcern;

    /**
     * @param DataProviderContract $provider
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index(DataProviderContract $provider): JsonResponse
    {
        return $this->response()->paginator(
            $this->app->make(ListHandler::class)->handle($provider),
            $this->config->get('permission.resources.permission', PermissionResource::class)
        );
    }

    /**
     * @param DataProviderContract $provider
     * @return JsonResponse
     */
    public function show(DataProviderContract $provider)
    {
        return $this->response()->resource(
            $this->app->make(ShowHandler::class)->handle($provider),
            $this->config->get('permission.resources.permission', PermissionResource::class)
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
            $this->config->get('permission.resources.permission', PermissionResource::class)
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
            $this->config->get('permission.resources.permission', PermissionResource::class)
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
     * @param DataProviderContract $provider
     * @return JsonResponse
     */
    public function groupLists(DataProviderContract $provider)
    {
        return $this->response()->data(
            $this->app->make(GroupListHandler::class)->handle($provider)
        );
    }
}
