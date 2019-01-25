<?php

namespace CrCms\Permission\Models;

use CrCms\Foundation\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionModel extends Model
{
    use SoftDeletes;

    /**
     * @var null
     */
    protected $dateFormat = null;

    /**
     * @var string
     */
    protected $table = 'permissions';

    /**
     * @var bool
     */
    public $timestamps = true;
}