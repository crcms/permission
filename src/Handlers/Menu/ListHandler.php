<?php

namespace CrCms\Permission\Handlers\Menu;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Repositories\MenuRepository;
use CrCms\Permission\Tasks\FilterDataTask;
use CrCms\Permission\Tasks\FormatTreeTask;
use Illuminate\Support\Collection;

class ListHandler extends AbstractHandler
{
    public function handle(DataProviderContract $provider)
    {
        /* @var MenuRepository $repository */
        $repository = $this->app->make(MenuRepository::class);

        $models = $repository->paginate($provider->all());

        return $this->format($provider,$models);
    }

    /**
     * @param DataProviderContract $provider
     * @param Collection $collect
     * @return array
     */
    protected function format(DataProviderContract $provider, Collection $collect): array
    {
        $temp = $collect->toArray();

        //获取过滤的字段
        $field = $provider->get('filter');

        //数据字段过滤
        $formatTask = $this->app->make(FilterDataTask::class);
        $format = $formatTask->handle($temp, $field);

        //无限极分类
        $task = $this->app->make(FormatTreeTask::class);
        $data = $task->handle($format);

        return $data;
    }
}