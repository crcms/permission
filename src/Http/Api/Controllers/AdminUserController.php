<?php

namespace CrCms\Permission\Http\Api\Controllers;

use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Http\DataProviders\AdminUser\AdminUserRolesUpdateDataProvider;
use CrCms\Permission\Models\Traits\NodesInformationTrait;
use Illuminate\Routing\Controller;

class AdminUserController extends Controller
{
    use NodesInformationTrait;

    public function userFields(DataProviderContract $provider)
    {
        dd($this->nodesOfMenus());
        dd($this->nodesOfPermissions());
        dd($this->nodesOfFields());
    }
}