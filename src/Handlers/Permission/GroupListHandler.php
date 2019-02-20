<?php

namespace CrCms\Permission\Handlers\Permission;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Handlers\Contracts\HandlerContract;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Models\PermissionModel;
use CrCms\Permission\Repositories\PermissionRepository;

class GroupListHandler extends AbstractHandler implements HandlerContract
{
    /**
     * @param DataProviderContract $provider
     * @return array
     */
    public function handle(DataProviderContract $provider): array
    {
        /* @var PermissionRepository $repository */
        $repository = $this->app->make(PermissionRepository::class);

        return $repository->allBy($provider->all())->map(function (PermissionModel $permission) {
            return $permission->only(['id', 'title', 'route', 'tags']);
        })->groupBy('tags')->toArray();
    }
}