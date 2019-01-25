<?php

namespace CrCms\Permission\Http\DataProviders\Permission;

use CrCms\Foundation\Transporters\AbstractValidateDataProvider;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use Illuminate\Validation\Rule;

class StoreDataProvider extends AbstractValidateDataProvider
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'route' => ['required', 'max:255', 'string', 'unique:permissions,route'],
            'action' => ['required', 'max:255', 'string', Rule::in(CommonConstant::ACTION_LIST)],
            'status' => ['required', 'integer', Rule::in(array_keys(CommonConstant::STATUS_LIST))],
            'title' => ['sometimes', 'string', 'max:255'],
            'remark' => ['sometimes', 'string', 'max:255'],
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'route' => '路由',
            'action' => '请求方法',
            'status' => '状态',
            'title' => '权限标题',
            'remark' => '备注',
        ];
    }
}
