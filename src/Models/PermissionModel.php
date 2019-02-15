<?php

namespace CrCms\Permission\Models;

use CrCms\Foundation\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionModel extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'permissions';
}
