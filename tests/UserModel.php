<?php

namespace CrCms\Permission\Tests;


use CrCms\Permission\Contracts\UserRoleRelationContract;
use CrCms\Permission\Models\Traits\UserRoleRelationTrait;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model implements UserRoleRelationContract
{
    protected $table = false;

    public $guarded = [];

    use UserRoleRelationTrait;
}
