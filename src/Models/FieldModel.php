<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/25
 * Time: 9:58
 */

namespace CrCms\Permission\Models;

use CrCms\Foundation\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldModel extends Model
{
    use SoftDeletes;

    /**
     * @var null
     */
    protected $dateFormat = null;

    /**
     * @var string
     */
    protected $table = 'fields';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}