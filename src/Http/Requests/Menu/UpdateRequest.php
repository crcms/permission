<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/23
 * Time: 9:34
 */

namespace CrCms\Permission\Http\Requests\Menu;

use CrCms\Foundation\Transporters\AbstractValidateDataProvider;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use Illuminate\Validation\Rule;

class UpdateRequest extends AbstractValidateDataProvider
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:128', Rule::unique('menus')->ignore($this->get('menu'))],
            'url' => ['sometimes', 'string', 'max:255'],
            'route' => ['sometimes', 'string', 'max:128'],
            'status' => ['required', 'integer', Rule::in(array_keys(CommonConstant::STATUS_LIST))],
            'sort' => ['required', 'integer'],
            'pid' => ['required', 'integer', function ($attribute, $value, $fail) {
                    if ((int)$value === (int)$this->get('menu')) {
                        throw new \InvalidArgumentException('父级id不能为本身');
                    }
                }
            ],
            'remark' => ['sometimes', 'string', 'max:255']
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'title' => '菜单标题',
            'url' => '链接',
            'route' => '路由',
            'status' => '状态',
            'sort' => '排序',
            'pid' => '父级id',
            'remark' => '备注',
        ];
    }
}