<?php

namespace CrCms\Permission\Tests;

use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\DB;
use CrCms\Permission\Models\RoleModel;
use CrCms\Permission\Models\PermissionModel;
use CrCms\Permission\Tasks\UserPermissionTask;
use CrCms\Foundation\Transporters\DataProvider;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use CrCms\Permission\Handlers\Role\RolePermissionUpdateHandler;

class UserPermissionTaskTest extends TestCase
{
    use ApplicationTrait;

    public static $userId = 1;

    public function prepare($super = false, $forbid = true)
    {
//        DB::table('roles')->truncate();
//        DB::table('permissions')->truncate();
        $role1 = RoleModel::create([
            'name' => Str::random(10),
            'super' => $super ? CommonConstant::SUPER_YES : CommonConstant::SUPER_NO,
            'remark' => Str::random(255),
            'status' => CommonConstant::STATUS_NORMAL,
        ]);
        $role2 = RoleModel::create([
            'name' => Str::random(10),
            'super' => CommonConstant::SUPER_NO,
            'remark' => Str::random(255),
            'status' => CommonConstant::STATUS_NORMAL,
        ]);
        $role3 = RoleModel::create([
            'name' => Str::random(10),
            'super' => CommonConstant::SUPER_NO,
            'remark' => Str::random(255),
            'status' => $forbid ? CommonConstant::STATUS_FORBID : CommonConstant::STATUS_NORMAL,
        ]);

        $permission1 = PermissionModel::create([
            'title' => Str::random(10),
            'route' => 'r1',
            'action' => Str::random(10),
            'remark' => Str::random(255),
            'status' => CommonConstant::STATUS_NORMAL,
        ]);
        $permission2 = PermissionModel::create([
            'title' => Str::random(10),
            'route' => 'r2',
            'action' => Str::random(10),
            'remark' => Str::random(255),
            'status' => CommonConstant::STATUS_NORMAL,
        ]);
        $permission3 = PermissionModel::create([
            'title' => Str::random(10),
            'route' => 'r3',
            'action' => Str::random(10),
            'remark' => Str::random(255),
            'status' => CommonConstant::STATUS_NORMAL,
        ]);

        $permissions = [$permission1->id, $permission2->id, $permission3->id];

        for ($i = 0; $i < count($permissions); $i++) {
            $handler = new RolePermissionUpdateHandler();
            $var = 'role'.strval($i + 1);
            $id = ${$var}->id;
            $handler->handle(new DataProvider(['id' => $id, 'permission' => [$permissions[$i]]]));
        }

        DB::table('user_roles')->delete();
        DB::table('user_roles')->insert([
            ['user_id' => static::$userId, 'role_id' => $role1->id],
            ['user_id' => static::$userId, 'role_id' => $role2->id],
            ['user_id' => static::$userId, 'role_id' => $role3->id],
        ]);
    }

    public function testNotSuperUserPermission()
    {
        $this->prepare(false, false);

        $user = new UserModel(['id' => 1]);

        $task = new UserPermissionTask();
        $result = $task->handle($user);

        $this->assertEquals(true, in_array('r1', $result));
        $this->assertEquals(true, in_array('r2', $result));
        $this->assertEquals(true, in_array('r3', $result));
    }
}
