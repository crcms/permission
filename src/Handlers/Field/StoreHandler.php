<?php

namespace CrCms\Permission\Handlers\Field;

use CrCms\Permission\Models\FieldModel;
use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Permission\Repositories\FieldRepository;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;

final class StoreHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return FieldModel
     */
    public function handle(DataProviderContract $provider): FieldModel
    {
        /* @var FieldRepository $repository */
        $repository = $this->app->make(FieldRepository::class);

        return $repository->setGuard(['table_name', 'field_key', 'name'])->create($provider->all());
    }
}
