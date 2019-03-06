<?php

namespace CrCms\Permission\Handlers\Menu;

use CrCms\Permission\Models\MenuModel;
use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Permission\Repositories\MenuRepository;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;

class UpdateHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return MenuModel
     */
    public function handle(DataProviderContract $provider): MenuModel
    {
        /* @var MenuRepository $repository */
        $repository = $this->app->make(MenuRepository::class);

        return $repository->update($provider->all(), $provider->get('menu'));
    }
}
