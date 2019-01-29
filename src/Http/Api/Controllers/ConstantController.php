<?php

namespace CrCms\Permission\Http\Api\Controllers;

use CrCms\Foundation\Helpers\InstanceConcern;
use CrCms\Foundation\Services\ResponseTrait;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Handlers\Constant\SearchHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class ConstantController extends Controller
{
    use ResponseTrait, InstanceConcern;

    /**
     * @param DataProviderContract $provider
     * @return JsonResponse
     */
    public function getConstant(DataProviderContract $provider): JsonResponse
    {
        return $this->response()->data(
            $this->app->make(SearchHandler::class)->handle($provider)
        );
    }
}