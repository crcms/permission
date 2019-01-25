<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/24
 * Time: 11:31
 */

namespace CrCms\Permission\Http\Api\Controllers;

use CrCms\Foundation\Services\ResponseTrait;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Handlers\Permission\DestroyHandler;
use CrCms\Permission\Handlers\Permission\ListHandler;
use CrCms\Permission\Handlers\Permission\ShowHandler;
use CrCms\Permission\Handlers\Permission\StoreHandler;
use CrCms\Permission\Handlers\Permission\UpdateHandler;
use CrCms\Permission\Http\Api\Resources\PermissionResource;
use CrCms\Permission\Http\Requests\Permission\StoreRequest;
use CrCms\Permission\Http\Requests\Permission\UpdateRequest;
use Illuminate\Routing\Controller;

class PermissionController extends Controller
{
    use ResponseTrait;

    /**
     * @param DataProviderContract $provider
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index(DataProviderContract $provider)
    {
        return $this->response()->paginator(
            app(ListHandler::class)->handle($provider),
            PermissionResource::class,
            ['only' => ['id', 'title', 'route', 'action', 'status_text', 'created_at']]
        );
    }

    /**
     * @param DataProviderContract $provider
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function show(DataProviderContract $provider)
    {
        return $this->response()->resource(
            app(ShowHandler::class)->handle($provider),
            PermissionResource::class
        );
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(StoreRequest $request)
    {
        return $this->response()->resource(
            app(StoreHandler::class)->handle($request),
            PermissionResource::class
        );
    }

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update(UpdateRequest $request)
    {
        return $this->response()->resource(
            app(UpdateHandler::class)->handle($request),
            PermissionResource::class
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
}