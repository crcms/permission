<?php

namespace CrCms\Permission\Handlers\Menu;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Models\MenuModel;
use CrCms\Permission\Repositories\MenuRepository;

class ShowHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return MenuModel
     */
    public function handle(DataProviderContract $provider): MenuModel
    {
        /* @var MenuRepository $repository */
        $repository = $this->app->make(MenuRepository::class);

        return $repository->single($provider->all());
    }
}