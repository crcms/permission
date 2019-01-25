<?php

namespace CrCms\Permission\Models;

use CrCms\Foundation\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuModel extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string
     */
    protected $table = 'menus';

    /**
     * @var bool
     */
    public $timestamps = true;
}
