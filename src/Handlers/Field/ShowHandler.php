<?php

namespace CrCms\Permission\Handlers\Field;

use CrCms\Permission\Models\FieldModel;
use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Permission\Repositories\FieldRepository;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;

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

        return $repository->byIntIdOrFail($provider->get('field'));
    }
}
