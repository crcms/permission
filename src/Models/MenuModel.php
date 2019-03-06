<?php

namespace CrCms\Permission\Models;

use Kalnoy\Nestedset\NodeTrait;
use CrCms\Foundation\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuModel extends Model
{
    use SoftDeletes, NodeTrait;

    /**
     * @var string
     */
    protected $table = 'menus';
}
