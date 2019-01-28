<?php

namespace CrCms\Permission\Tests\Permission;

use CrCms\Foundation\Transporters\DataProvider;
use CrCms\Permission\Handlers\Permission\DestroyHandler;
use CrCms\Permission\Handlers\Permission\ListHandler;
use CrCms\Permission\Handlers\Permission\ShowHandler;
use CrCms\Permission\Handlers\Permission\StoreHandler;
use CrCms\Permission\Handlers\Permission\UpdateHandler;
use CrCms\Permission\Models\PermissionModel;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use CrCms\Permission\Tests\ApplicationTrait;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class PermissionTest extends TestCase
{
    use ApplicationTrait;

    public function testStore()
    {
        $handler = new StoreHandler();

        $data = [
            'title' => Str::random(255),
            'route' => Str::random(255),
            'action' => Str::random(255),
            'remark' => Str::random(255),
            'status' => CommonConstant::STATUS_FORBID,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(PermissionModel::class, $result);
        $this->assertEquals($data['title'], $result->title);
        $this->assertEquals($data['route'], $result->route);
        $this->assertEquals($data['action'], $result->action);
        $this->assertEquals($data['remark'], $result->remark);
        $this->assertEquals($data['status'], $result->status);

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
    public function testShow(PermissionModel $model)
    {
        $handler = new ShowHandler();

        $data = [
            'permission' => $model->id,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(PermissionModel::class, $result);
        $this->assertEquals($model->title, $result->title);
        $this->assertEquals($model->route, $result->route);
        $this->assertEquals($model->action, $result->action);
        $this->assertEquals($model->remark, $result->remark);
        $this->assertEquals($model->status, $result->status);
    }

    /**
     * @depends testStore
     */
    public function testUpdate(PermissionModel $model)
    {
        $handler = new UpdateHandler();

        $data = [
            'title' => Str::random(255),
            'route' => Str::random(255),
            'action' => Str::random(255),
            'remark' => Str::random(255),
            'status' => CommonConstant::STATUS_NORMAL,
            'permission' => $model->id,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(PermissionModel::class, $result);
        $this->assertEquals($data['title'], $result->title);
        $this->assertEquals($data['route'], $result->route);
        $this->assertEquals($data['action'], $result->action);
        $this->assertEquals($data['remark'], $result->remark);
        $this->assertEquals($data['status'], $result->status);
    }

    /**
     * @depends testStore
     */
    public function testDestroy(PermissionModel $model)
    {
        $handler = new DestroyHandler();

        $data = [
            'permission' => $model->id,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertEquals(1, $result);
    }
}