<?php

namespace CrCms\Permission\Tests\Role;

use CrCms\Foundation\Transporters\DataProvider;
use CrCms\Permission\Handlers\Role\StoreHandler;
use CrCms\Permission\Handlers\Role\UpdateHandler;
use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use CrCms\Permission\Tests\ApplicationTrait;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

/**
 * Class RoleTest
 * @package CrCms\Permission\Tests\Role
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

        $this->assertInstanceOf(RoleModel::class,$result);

        $this->assertEquals($data['name'],$result->name);
        $this->assertEquals($data['super'],$result->super);
        $this->assertEquals($data['status'],$result->status);

        return $result;
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

        $this->assertInstanceOf(RoleModel::class,$result);

        $this->assertEquals($data['name'],$result->name);
        $this->assertEquals($data['super'],$result->super);
        $this->assertEquals($data['status'],$result->status);
    }
}
