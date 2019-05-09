<?php

namespace CrCms\Permission\Models;

use CrCms\Foundation\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionModel extends AbstractModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'permissions';
}
