<?php

namespace CrCms\Permission\Tests\Role;

use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;
use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Tests\ApplicationTrait;
use CrCms\Foundation\Transporters\DataProvider;
use CrCms\Permission\Handlers\Role\ListHandler;
use CrCms\Permission\Handlers\Role\ShowHandler;
use Illuminate\Pagination\LengthAwarePaginator;
use CrCms\Permission\Handlers\Role\StoreHandler;
use CrCms\Permission\Handlers\Role\UpdateHandler;
use CrCms\Permission\Handlers\Role\DestroyHandler;
use CrCms\Permission\Handlers\Role\RoleMenusUpdateHandler;
use CrCms\Permission\Handlers\Role\RoleFieldsUpdateHandler;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use CrCms\Permission\Handlers\Role\RolePermissionUpdateHandler;

/**
 * Class RoleTest.
 */
class RoleTest extends TestCase
{
    use ApplicationTrait;

    public function testStore()
    {
        $handler = new StoreHandler();

        $data = [
            'name' => Str::random(10),
            'super' => CommonConstant::SUPER_YES,
            'remark' => Str::random(255),
            'status' => CommonConstant::STATUS_NORMAL,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(RoleModel::class, $result);

        $this->assertEquals($data['name'], $result->name);
        $this->assertEquals($data['super'], $result->super);
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
    public function testShow(RoleModel $role)
    {
        $handler = new ShowHandler();

        $data = [
            'role' => $role->id,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(RoleModel::class, $result);
        $this->assertEquals($role->name, $result->name);
        $this->assertEquals($role->status, $result->status);
        $this->assertEquals($role->super, $result->super);
        $this->assertEquals($role->remark, $result->remark);
    }

    /**
     * @depends testStore
     */
    public function testUpdate(RoleModel $role)
    {
        $handler = new UpdateHandler();

        $data = [
            'name' => Str::random(10),
            'super' => CommonConstant::SUPER_NO,
            'status' => CommonConstant::STATUS_FORBID,
            'role' => $role->id,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(RoleModel::class, $result);

        $this->assertEquals($data['name'], $result->name);
        $this->assertEquals($data['super'], $result->super);
        $this->assertEquals($data['status'], $result->status);
    }

    /**
     * @depends testStore
     */
//    public function testRolePermissionUpdate(RoleModel $role)
//    {
//        $handler = new RolePermissionUpdateHandler();
//
//        $data = [
//            'id' => $role->id,
//            'permission' => [1, 2, 3, 4, 5]
//        ];
//
//        $result = $handler->handle(new DataProvider($data));
//
//        $this->assertInstanceOf(RoleModel::class,$result);
//    }

    /**
     * @depends testStore
     */
    public function testRoleMenusUpdate(RoleModel $role)
    {
        $handler = new RoleMenusUpdateHandler();

        $data = [
            'id' => $role->id,
            'menu' => [1, 2, 3, 4],
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(RoleModel::class, $result);
    }

    /**
     * @depends testStore
     */
    public function testRoleFieldsUpdate(RoleModel $role)
    {
        $handler = new RoleFieldsUpdateHandler();

        $data = [
            'id' => $role->id,
            'field' => [2, 3, 4],
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(RoleModel::class, $result);
    }

    /**
     * @depends testStore
     */
    public function testDestroy(RoleModel $role)
    {
        $handler = new DestroyHandler();

        $data = [
            'role' => $role->id,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertEquals(1, $result);
    }
}
