<?php

namespace CrCms\Permission\Handlers\Menu;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Repositories\MenuRepository;

class DestroyHandler extends AbstractHandler
{
    /**
     * @param DataProviderContract $provider
     * @return int
     * @throws \Exception
     */
    public function handle(DataProviderContract $provider): int
    {
        /* @var MenuRepository $repository */
        $repository = $this->app->make(MenuRepository::class);

        $ids = $repository->descendantAndSelfById($provider->get('menu'))->pluck('id')->toArray();

        return $repository->delete($ids);
    }
}
