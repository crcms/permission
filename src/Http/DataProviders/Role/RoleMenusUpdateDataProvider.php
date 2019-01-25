<?php

namespace CrCms\Permission\Http\DataProviders\Role;

use CrCms\Foundation\Transporters\AbstractValidateDataProvider;

class RoleMenusUpdateDataProvider extends AbstractValidateDataProvider
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:roles,id'],
            'menu' => ['required', 'array', 'exists:menus,id'],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'id' => '角色id',
            'menu' => '菜单id'
        ];
    }
}
