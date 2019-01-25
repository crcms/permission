<?php

namespace CrCms\Permission\Handlers\Menu;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Repositories\MenuRepository;

class SearchHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return array
     */
    public function handle(DataProviderContract $provider): array
    {
        /* @var MenuRepository $repository */
        $repository = $this->app->make(MenuRepository::class);

        return $repository->getTreeList($provider->all());
    }
}