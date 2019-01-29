<?php

namespace CrCms\Permission\Handlers\Constant;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;

class SearchHandler extends AbstractHandler
{
    /**
     * 获取常量
     *
     * @param DataProviderContract $provider
     * @return array
     * @throws \ReflectionException
     */
    public function handle(DataProviderContract $provider): array
    {
        $path = base_path('packages/permission/src/Repositories/Constants');
        $files = scandir($path);

        $constants = [];

        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } else {
                $constants[substr($file, 0, -4)] = $this->reflectConstantFile(basename($file));
            }
        }

        return $constants;
    }

    /**
     * @param $fileName
     * @return mixed
     * @throws \ReflectionException
     */
    protected function reflectConstantFile($fileName)
    {
        $className = $this->fixClassName($fileName);
        $constants = $this->getConstants($className);
        $listConstants = $this->listConstants($constants);
        return $listConstants;
    }

    /**
     * 文件反射 获取常量
     *
     * @param $className
     * @return array
     * @throws \ReflectionException
     */
    protected function getConstants($className)
    {
        $reflect = new \ReflectionClass($className);
        return $reflect->getConstants();
    }

    /**
     * 常量数据过滤
     *
     * @param $constants
     * @return array
     */
    protected function listConstants($constants): array
    {
        return collect($constants)->filter(function ($value, $key) {
            return is_array($value);
        })->map(function(&$item,$key){
            krsort($item);
            return $item;
        })->toArray();
    }

    /**
     * 格式化常量命名空间
     *
     * @param $fileName
     * @return string
     */
    protected function fixClassName($fileName): string
    {
        $prefix = 'CrCms\Permission\Repositories\Constants\\';
        return $prefix . substr($fileName, 0, -4);
    }
}