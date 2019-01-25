<?php

namespace CrCms\Permission\Handlers\Field;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Models\FieldModel;
use CrCms\Permission\Repositories\FieldRepository;

class UpdateHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return FieldModel
     */
    public function handle(DataProviderContract $provider): FieldModel
    {
        /* @var FieldRepository $repository */
        $repository = $this->app->make(FieldRepository::class);

        //整合数据
        $input = $provider->all();

        $guard = ['name'];

        return $repository->setGuard($guard)->update($input, $provider->get('field'));
    }
}