<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/23
 * Time: 17:48
 */

namespace CrCms\Permission\Http\Api\Controllers;

use CrCms\Foundation\Services\ResponseTrait;

use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Handlers\Role\DestroyHandler;
use CrCms\Permission\Handlers\Role\ListHandler;
use CrCms\Permission\Handlers\Role\RoleFieldsUpdateHandler;
use CrCms\Permission\Handlers\Role\RoleMenusUpdateHandler;
use CrCms\Permission\Handlers\Role\RolePermissionUpdateHandler;
use CrCms\Permission\Handlers\Role\ShowHandler;
use CrCms\Permission\Handlers\Role\StoreHandler;
use CrCms\Permission\Handlers\Role\UpdateHandler;
use CrCms\Permission\Http\Api\Resources\RoleResource;
use CrCms\Permission\Http\Requests\Role\RoleFieldsUpdateRequest;
use CrCms\Permission\Http\Requests\Role\RoleMenusUpdateRequest;
use CrCms\Permission\Http\Requests\Role\RolePermissionUpdateRequest;
use CrCms\Permission\Http\Requests\Role\StoreRequest;
use CrCms\Permission\Http\Requests\Role\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class RoleController extends Controller
{
    use ResponseTrait;

    /**
     * @param DataProviderContract $provider
     * @return JsonResponse
     * @throws \Exception
     */
    public function index(DataProviderContract $provider): JsonResponse
    {
        return $this->response()->paginator(
            app(ListHandler::class)->handle($provider),
            RoleResource::class,
            ['only' => ['id', 'name', 'status_text', 'super_text', 'created_at']]
        );
    }

    /**
     * @param DataProvider $provider
     * @return JsonResponse
     * @throws \Exception
     */
    public function show(DataProviderContract $provider)
    {
        return $this->response()->resource(
            app(ShowHandler::class)->handle($provider),
            RoleResource::class
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
            RoleResource::class
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
            RoleResource::class
        );
    }

    /**
     * @param DataProvider $provider
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DataProviderContract $provider)
    {
        app(DestroyHandler::class)->handle($provider);

        return $this->response()->noContent();
    }

    /**
     * @param RolePermissionUpdateRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function rolePermissionUpdate(RolePermissionUpdateRequest $request)
    {
        return $this->response()->resource(
            app(RolePermissionUpdateHandler::class)->handle($request),
            RoleResource::class
        );
    }

    /**
     * @param RoleMenusUpdateRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function roleMenusUpdate(RoleMenusUpdateRequest $request)
    {
        return $this->response()->resource(
            app(RoleMenusUpdateHandler::class)->handle($request),
            RoleResource::class
        );
    }

    /**
     * @param RoleFieldsUpdateRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function roleFieldsUpdate(RoleFieldsUpdateRequest $request)
    {
        return $this->response()->resource(
            app(RoleFieldsUpdateHandler::class)->handle($request),
            RoleResource::class
        );
    }
}