<?php

namespace CrCms\Permission\Http\Api\Controllers;

use CrCms\Foundation\Helpers\InstanceConcern;
use CrCms\Foundation\Services\ResponseTrait;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Handlers\Menu\DestroyHandler;
use CrCms\Permission\Handlers\Menu\ListHandler;
use CrCms\Permission\Handlers\Menu\ShowHandler;
use CrCms\Permission\Handlers\Menu\StoreHandler;
use CrCms\Permission\Handlers\Menu\UpdateHandler;
use CrCms\Permission\Http\Api\Resources\MenuResource;
use CrCms\Permission\Http\DataProviders\Menu\StoreDataProvider;
use CrCms\Permission\Http\DataProviders\Menu\UpdateDataProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class MenuController
 * @package CrCms\Permission\Http\Api\Controllers
 */
class MenuController extends Controller
{
    use ResponseTrait, InstanceConcern;

    /**
     * @param DataProviderContract $provider
     * @return JsonResponse
     * @throws \Exception
     */
    public function index(DataProviderContract $provider): JsonResponse
    {
        return $this->response()->collection(
            $this->app->make(ListHandler::class)->handle($provider),
            $this->config->get('permission.resources.menu',MenuResource::class)
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
            $this->config->get('permission.resources.menu',MenuResource::class)
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
            $this->config->get('permission.resources.menu',MenuResource::class)
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
            $this->config->get('permission.resources.menu',MenuResource::class)
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
}
