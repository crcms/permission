<?php

namespace CrCms\Permission\Repositories;

use CrCms\Permission\Models\FieldModel;
use CrCms\Permission\Repositories\Magic\FieldMagic;
use CrCms\Repository\AbstractRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class FieldRepository extends AbstractRepository
{
    /**
     * @return FieldModel
     */
    public function newModel(): FieldModel
    {
        return new FieldModel;
    }

    /**
     * @param array $data
     * @return LengthAwarePaginator
     */
    public function paginate(array $data): LengthAwarePaginator
    {
        return $this->magic(new FieldMagic($data))->paginate();
    }
}
