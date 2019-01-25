<?php

namespace CrCms\Permission\Models;

use CrCms\Foundation\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldModel extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'fields';

    /**
     * @var bool
     */
    public $timestamps = true;

}