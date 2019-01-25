<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/23
 * Time: 9:58
 */

namespace CrCms\Permission\Handlers\Menu;

use CrCms\Foundation\Handlers\AbstractHandler;
use CrCms\Foundation\Transporters\Contracts\DataProviderContract;
use CrCms\Permission\Http\Api\Resources\MenuResource;
use CrCms\Permission\Repositories\MenuRepository;
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
     * @param array $filter
     * @return array
     */
    protected function format(DataProviderContract $provider, Collection $collect): array
    {
        $resources = MenuResource::collection($collect);

        //获取资源的头信息
        $condition = $resources->collection->first()->condition($provider);

        //获取过滤字段
        $filter = $provider->get('filter');
        if (empty($filter)) {
            $temp = $resources->resolve();
            $headings = $resources->collection->first()->headings($provider);
        } else {
            $temp = $resources->only($filter)->resolve();
            $tempHeadings = $resources->collection->first()->headings($provider);
            $headings = collect($tempHeadings)->only($filter)->toArray();
        }

        //递归菜单
        $data = formateTree($temp);

        return ['data'=>$data,'headings' => $headings,'condition' => $condition];
    }
}