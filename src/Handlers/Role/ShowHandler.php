<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/24
 * Time: 10:37
 */

namespace CrCms\Permission\Handlers\Role;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Repositories\RoleRepository;

class ShowHandler extends AbstractHandler
{

    public function handle(DataProviderContract $provider): RoleModel
    {
        /* @var RoleRepository $repository*/
        $repository = app(RoleRepository::class);

        return $repository->single($provider->all());
    }
}