<?php

namespace CrCms\Permission\Tests\Menu;

use CrCms\Foundation\Transporters\DataProvider;
use CrCms\Permission\Handlers\Menu\DestroyHandler;
use CrCms\Permission\Handlers\Menu\StoreHandler;
use CrCms\Permission\Handlers\Menu\UpdateHandler;
use CrCms\Permission\Http\Api\Resources\MenuResource;
use CrCms\Permission\Models\MenuModel;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use CrCms\Permission\Tests\ApplicationTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\Collection;
use PHPUnit\Framework\TestCase;

class MenuLevelTest extends TestCase
{
    use ApplicationTrait;


    public function testParentStore()
    {
        $handler = new StoreHandler();

        $parentId = null;

        $parentIds = [];

        for ($i=0;$i<=3;$i++) {


            $data = [
                'title' => Str::random(10),
                'url' => Str::random(10),
                'route' => Str::random(10),
                'remark' => Str::random(255),
                'sort' => mt_rand(0, 1000),
                'status' => CommonConstant::STATUS_NORMAL,
            ];

            if (isset($result) && $result instanceof MenuModel) {
                $data['parent_id'] = $result->id;
                $parentIds[] = $result->id;
            }

            $result = $handler->handle(new DataProvider($data));

            $this->assertInstanceOf(MenuModel::class, $result);
            $this->assertEquals($data['title'], $result->title);
            $this->assertEquals($data['url'], $result->url);
            $this->assertEquals($data['route'], $result->route);
            $this->assertEquals($data['sort'], $result->sort);
            $this->assertEquals($data['status'], $result->status);
            if (isset($data['parent_id'])) {
                $this->assertEquals($data['parent_id'], $result->parent_id);
            }
        }


        return ['result' => $result,'parent_ids' => $parentIds];
    }

    /**
     * testUpdate
     *
     * @depends testParentStore
     *
     * @param MenuModel $menu
     * @return void
     */
    public function testUpdate(array $extends)
    {
        $menu = $extends['result'];
        $parent_id = $menu->parent_id;

        $handler = new UpdateHandler();
//
        $data = [
            'title' => Str::random(10),
            'url' => Str::random(10),
            'route' => Str::random(20),
            'remark' => Str::random(255),
            'sort' => mt_rand(0, 1000),
            'menu' => $menu->id,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(MenuModel::class, $result);
        $this->assertEquals($data['title'], $result->title);
        $this->assertEquals($data['url'], $result->url);
        $this->assertEquals($data['route'], $result->route);
        $this->assertEquals($data['sort'], $result->sort);
        $this->assertEquals($parent_id, $result->parent_id);

        return $extends['parent_ids'];
    }

    /**
     * testDestroy
     *
     * @depends testUpdate
     *
     * @param array $parentIds
     * @return void
     *
     * @throws \Exception
     */
    public function testDestroy(array $parentIds)
    {
        $temp = MenuModel::create([
            'title' => Str::random(10),
            'url' => Str::random(10),
            'route' => Str::random(20),
            'remark' => Str::random(255),
            'sort' => mt_rand(0, 1000),
        ]);

        $parentId = min($parentIds);

        $handler = new DestroyHandler();
        $handler->handle(new DataProvider(['menu' => $parentId]));

        $result = MenuModel::whereIn('id',$parentIds)->get();

        $result2 = MenuModel::find($temp->id);

        $this->assertEquals(true,$result->isEmpty());
        $this->assertInstanceOf(MenuModel::class,$result2);
    }
}
