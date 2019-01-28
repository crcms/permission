<?php

namespace CrCms\Permission\Tasks;

use CrCms\Foundation\Tasks\AbstractTask;

class FormatTreeTask extends AbstractTask
{
    /**
     * 无限极格式化树状数
     * @param mixed ...$params
     * @return array|mixed
     */
    public function handle(...$params)
    {
        $cates = $params[0];
        $pid = $params[1] ?? 0;
        $field = $params[2] ?? 'pid';

        $data = [];

        if (empty($cates)) {
            return $data;
        }

        //递归分类
        foreach ($cates as $key => $item) {
            if ($item[$field] == $pid) {
                $data[$item['id']] = $item;

                $temp = $this->handle($cates,$item['id'],$field);

                if (!empty($temp)) {
                    $data[$item['id']]['children'] = array_values($temp);
                }
            }
        }

        return array_values($data);
    }
}