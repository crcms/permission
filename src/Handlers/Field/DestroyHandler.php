<?php

namespace CrCms\Permission\Handlers\Field;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Repositories\FieldRepository;

class DestroyHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return int
     */
    public function handle(DataProviderContract $provider): int
    {
        /* @var FieldRepository $repository */
        $repository = $this->app->make(FieldRepository::class);

        return $repository->delete($provider->get('field'));
    }
}