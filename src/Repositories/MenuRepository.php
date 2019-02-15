<?php

namespace CrCms\Permission\Repositories;

use CrCms\Permission\Models\MenuModel;
use CrCms\Repository\AbstractRepository;
use Illuminate\Support\Collection;

class MenuRepository extends AbstractRepository
{
    /**
     * @var array
     */
    protected $guard = ['title', 'url', 'route', 'icon', 'sort', 'status', 'parent_id', 'remark'];

    /**
     * @return MenuModel
     */
    public function newModel(): MenuModel
    {
        return new MenuModel;
    }

    /**
     * descendantAndSelfById
     *
     * @param int $id
     * @return Collection
     */
    public function descendantAndSelfById(int $id): Collection
    {
        return MenuModel::descendantsAndSelf($id);
    }

    /**
     * allToTree
     *
     * @return Collection
     */
    public function allToTree(): Collection
    {
        return $this->all()->toTree();
    }
}
