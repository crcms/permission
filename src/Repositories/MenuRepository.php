<?php

namespace CrCms\Permission\Repositories;

use CrCms\Permission\Models\MenuModel;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use CrCms\Permission\Repositories\Magic\MenuMagic;
use CrCms\Repository\AbstractRepository;
use Illuminate\Support\Collection;

class MenuRepository extends AbstractRepository
{
    /**
     * @return MenuModel
     */
    public function newModel(): MenuModel
    {
        return new MenuModel;
    }

    /**
     * @param array $data
     * @return Collection
     */
    public function paginate(array $data): Collection
    {
        return $this->magic(new MenuMagic($data))
            ->orderBy('sort', 'desc')
            ->get();
    }

    /**
     * @param array $data
     * @return MenuModel
     */
    public function single(array $data): MenuModel
    {
        return $this->byIntIdOrFail($data['menu']);
    }

    /**
     * 判断有无子集数据
     *
     * @param int $pid
     * @return mixed
     */
    public function hasChildren($pid = 0)
    {
        return $this->where('pid', $pid)->get();
    }

    /**
     * @param array $data
     * @return array
     */
    public function getTreeList(array $data): array
    {
        $models = $this->where('status', CommonConstant::STATUS_NORMAL)
            ->select($data['filter'] )
            ->orderBy('sort', 'desc')
            ->get();

        $temp = $this->tree($models);

        return array_values($temp);
    }

    /**
     * 无限分类
     * @param Collection $collection
     * @param int $pid
     * @param string $field
     * @param array $data
     * @return array
     */
    protected function tree(Collection $collection, $pid = 0, $field = 'pid', $data = []): array
    {
        if ($collection->isEmpty()) {
            return [];
        }

        $array = $collection->toArray();

        foreach ($array as $key => $value) {
            if ($value[$field] == $pid) {
                $data[$key] = $value;
                $tmp = $this->tree($collection, $value['id'], $field, $data);

                if (!empty($tmp)) {
                    foreach ($tmp as $k => $v) {
                        $data[$k] = $v;
                    }
                }
            }

        }

        return $data;
    }
}