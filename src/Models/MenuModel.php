<?php

namespace CrCms\Permission\Models;

use CrCms\Foundation\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class MenuModel extends Model
{
    use SoftDeletes, NodeTrait;

    /**
     * @var string
     */
    protected $table = 'menus';
}
