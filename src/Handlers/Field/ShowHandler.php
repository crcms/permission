<?php

namespace CrCms\Permission\Handlers\Field;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Models\FieldModel;
use CrCms\Permission\Repositories\FieldRepository;

class ShowHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return FieldModel
     */
    public function handle(DataProviderContract $provider): FieldModel
    {
        /* @var FieldRepository $repository */
        $repository = $this->app->make(FieldRepository::class);

        return $repository->single($provider->all());
    }
}