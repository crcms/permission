<?php

namespace CrCms\Permission\Models;

use Kalnoy\Nestedset\NodeTrait;
use CrCms\Foundation\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuModel extends AbstractModel
{
    use SoftDeletes, NodeTrait;

    /**
     * @var string
     */
    protected $table = 'menus';
}
