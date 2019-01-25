<?php

namespace CrCms\Permission\Http\Api\Controllers;

use CrCms\Foundation\Services\ResponseTrait;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Handlers\Menu\DestroyHandler;
use CrCms\Permission\Handlers\Menu\ListHandler;
use CrCms\Permission\Handlers\Menu\SearchHandler;
use CrCms\Permission\Handlers\Menu\ShowHandler;
use CrCms\Permission\Handlers\Menu\StoreHandler;
use CrCms\Permission\Handlers\Menu\UpdateHandler;
use CrCms\Permission\Http\Api\Resources\MenuResource;
use CrCms\Permission\Http\Requests\Menu\StoreRequest;
use CrCms\Permission\Http\Requests\Menu\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class MenuController
 * @package CrCms\Permission\Http\Api\Controllers
 */
class MenuController extends Controller
{
    use ResponseTrait;

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
            app(ListHandler::class)->handle($provider)
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
            app(ShowHandler::class)->handle($provider),
            MenuResource::class
        );
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function store(StoreRequest $request)
    {
        return $this->response()->resource(
            app(StoreHandler::class)->handle($request),
            MenuResource::class
        );
    }

    /**
     * @param UpdateRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(UpdateRequest $request)
    {
        return $this->response()->resource(
            app(UpdateHandler::class)->handle($request),
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
        app(DestroyHandler::class)->handle($provider);

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
            app(SearchHandler::class)->handle($provider)
        );
    }
}