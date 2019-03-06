<?php

namespace CrCms\Permission\Http\DataProviders\Role;

use CrCms\Foundation\Transporters\AbstractValidateDataProvider;

class RoleFieldsUpdateDataProvider extends AbstractValidateDataProvider
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:roles,id'],
            'field' => ['required', 'array', 'exists:fields,id'],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'id' => '角色id',
            'field' => '字段id',
        ];
    }
}
