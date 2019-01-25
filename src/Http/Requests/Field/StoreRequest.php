<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/25
 * Time: 10:38
 */

namespace CrCms\Permission\Http\Requests\Field;

use CrCms\Foundation\Transporters\AbstractValidateDataProvider;

class StoreRequest extends AbstractValidateDataProvider
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'table_name' => ['required', 'max:128', 'string'],
            'field' => ['required', 'max:128', 'string'],
            'name' => ['required', 'max:128', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'table_name' => '表名',
            'field' => '字段键',
            'name' => '字段名'
        ];
    }
}