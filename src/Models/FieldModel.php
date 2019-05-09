<?php

namespace CrCms\Permission\Models;

use CrCms\Foundation\Models\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldModel extends AbstractModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'fields';
}
