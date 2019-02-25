<?php

namespace CrCms\Permission\Handlers\Menu;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Repositories\Magic\MenuMagic;
use CrCms\Permission\Repositories\MenuRepository;

class ListHandler extends AbstractHandler
{
    /**
     * handle
     *
     * @param DataProviderContract $provider
     * @return \Illuminate\Support\Collection|mixed
     */
    public function handle(DataProviderContract $provider)
    {
        /* @var MenuRepository $repository */
        $repository = $this->app->make(MenuRepository::class);

        return $repository->magic(new MenuMagic($provider->all()))->get()->toTree();
    }
}
