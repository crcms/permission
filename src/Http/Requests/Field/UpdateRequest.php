<?php

namespace CrCms\Permission\Http\Requests\Field;

use CrCms\Foundation\Transporters\AbstractValidateDataProvider;

class UpdateRequest extends AbstractValidateDataProvider
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:128', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => '字段名',
        ];
    }
}