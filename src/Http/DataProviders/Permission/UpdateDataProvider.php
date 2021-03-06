<?php

namespace CrCms\Permission\Http\DataProviders\Permission;

use Illuminate\Validation\Rule;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use CrCms\Foundation\Transporters\AbstractValidateDataProvider;

class UpdateDataProvider extends AbstractValidateDataProvider
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'route' => ['required', 'max:255', 'string', Rule::unique('permissions')
                ->ignore($this->get('permission')), ],
            'action' => ['required', 'max:255', 'string', Rule::in(array_keys(CommonConstant::ACTION_LIST))],
            'status' => ['required', 'integer', Rule::in(array_keys(CommonConstant::STATUS_LIST))],
            'title' => ['sometimes', 'string', 'max:255'],
            'remark' => ['sometimes', 'string', 'max:255'],
            'tags' => ['required', 'max:30', 'string'],
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
            'tags' => '标签',
        ];
    }
}
