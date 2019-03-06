<?php

namespace CrCms\Permission\Tests\Field;

use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;
use CrCms\Permission\Models\FieldModel;
use CrCms\Permission\Tests\ApplicationTrait;
use CrCms\Foundation\Transporters\DataProvider;
use Illuminate\Pagination\LengthAwarePaginator;
use CrCms\Permission\Handlers\Field\ListHandler;
use CrCms\Permission\Handlers\Field\ShowHandler;
use CrCms\Permission\Handlers\Field\StoreHandler;
use CrCms\Permission\Handlers\Field\UpdateHandler;
use CrCms\Permission\Handlers\Field\DestroyHandler;

class FieldTest extends TestCase
{
    use ApplicationTrait;

    public function testStore()
    {
        $handler = new StoreHandler();

        $data = [
            'table_name' => Str::random(10),
            'field_key' => Str::random(10),
            'name' => Str::random(10),
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(FieldModel::class, $result);
        $this->assertEquals($data['table_name'], $result->table_name);
        $this->assertEquals($data['field_key'], $result->field_key);
        $this->assertEquals($data['name'], $result->name);

        return $result;
    }

    public function testList()
    {
        $handler = new ListHandler();

        $data = [];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);

        $this->assertObjectHasAttribute('total', $result);
        $this->assertObjectHasAttribute('perPage', $result);
        $this->assertObjectHasAttribute('currentPage', $result);
        $this->assertObjectHasAttribute('lastPage', $result);
    }

    /**
     * @depends testStore
     */
    public function testShow(FieldModel $model)
    {
        $handler = new ShowHandler();

        $data = [
            'field' => $model->id,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(FieldModel::class, $result);
        $this->assertEquals($model->table_name, $result->table_name);
        $this->assertEquals($model->field_key, $result->field_key);
        $this->assertEquals($model->name, $result->name);
    }

    /**
     * @depends testStore
     */
    public function testUpdate(FieldModel $model)
    {
        $handler = new UpdateHandler();

        $data = [
            'name' => Str::random(10),
            'field' => $model->id,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(FieldModel::class, $result);
        $this->assertEquals($data['name'], $result->name);
    }

    /**
     * @depends testStore
     */
    public function testDestroy(FieldModel $model)
    {
        $handler = new DestroyHandler();

        $data = [
            'field' => $model->id,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertEquals(1, $result);
    }
}
