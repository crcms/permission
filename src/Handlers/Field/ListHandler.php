<?php

namespace CrCms\Permission\Handlers\Field;

use CrCms\Foundation\Handlers\AbstractHandler;
use Illuminate\Contracts\Pagination\Paginator;
use CrCms\Permission\Repositories\FieldRepository;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;

class ListHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return Paginator
     */
    public function handle(DataProviderContract $provider): Paginator
    {
        /* @var FieldRepository $repository */
        $repository = $this->app->make(FieldRepository::class);

        return $repository->paginate($provider->all());
    }
}
