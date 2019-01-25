<?php

namespace CrCms\Permission\Http\Api\Controllers;

use CrCms\Foundation\Helpers\InstanceConcern;
use CrCms\Foundation\Services\ResponseTrait;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Handlers\Menu\DestroyHandler;
use CrCms\Permission\Handlers\Menu\ListHandler;
use CrCms\Permission\Handlers\Menu\SearchHandler;
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
        $filter = ['id', 'title', 'url', 'route', 'status_text', 'pid', 'created_at'];
        $provider['filter'] = $filter;

        return $this->response()->data(
            $this->app->make(ListHandler::class)->handle($provider)
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
            MenuResource::class
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
            MenuResource::class
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
            MenuResource::class
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
     * @throws \Exception
     */
    public function getList(DataProviderContract $provider)
    {
        $filter = ['id', 'title', 'pid'];
        $provider['filter'] = $filter;

        return $this->response()->data(
            $this->app->make(SearchHandler::class)->handle($provider)
        );
    }
}
