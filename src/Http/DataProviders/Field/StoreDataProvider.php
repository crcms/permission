<?php

namespace CrCms\Permission\Http\DataProviders\Field;

use CrCms\Foundation\Transporters\AbstractValidateDataProvider;

class StoreDataProvider extends AbstractValidateDataProvider
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'table_name' => ['required', 'max:128', 'string'],
            'field_key' => ['required', 'max:128', 'string'],
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
            'field_key' => '字段键',
            'name' => '字段名'
        ];
    }
}
