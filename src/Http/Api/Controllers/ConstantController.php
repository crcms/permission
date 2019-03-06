<?php

namespace CrCms\Permission\Http\Api\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use CrCms\Foundation\Services\ResponseTrait;
use CrCms\Foundation\Helpers\InstanceConcern;
use CrCms\Permission\Handlers\Constant\SearchHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;

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
