<?php

namespace CrCms\Permission\Tasks;

use CrCms\Foundation\Tasks\AbstractTask;

class FilterDataTask extends AbstractTask
{
    /**
     * @param mixed ...$params
     * @return array|mixed
     */
    public function handle(...$params)
    {
        $origin = $params[0];
        $field = $params[1] ?? [];

        if (empty($field)) {
            return $origin;
        }

        return array_map(function ($item) use ($field) {
            return array_filter($item, function ($key) use ($field, $item) {
                return in_array($key, $field, true);
            }, ARRAY_FILTER_USE_KEY);
        }, $origin);
    }
}