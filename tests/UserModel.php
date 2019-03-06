<?php

namespace CrCms\Permission\Tests;

use Illuminate\Database\Eloquent\Model;
use CrCms\Permission\Contracts\UserRoleRelationContract;
use CrCms\Permission\Models\Traits\UserRoleRelationTrait;

class UserModel extends Model implements UserRoleRelationContract
{
    protected $table = false;

    public $guarded = [];

    use UserRoleRelationTrait;
}
