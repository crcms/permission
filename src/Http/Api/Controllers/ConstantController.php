<?php

namespace CrCms\Permission\Http\Api\Controllers;

use CrCms\Foundation\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;
use CrCms\Permission\Handlers\Constant\SearchHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;

class ConstantController extends AbstractController
{
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
