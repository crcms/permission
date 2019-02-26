<?php

namespace CrCms\Permission\Tests\Menu;

use CrCms\Foundation\Transporters\DataProvider;
use CrCms\Permission\Handlers\Menu\DestroyHandler;
use CrCms\Permission\Handlers\Menu\ListHandler;
use CrCms\Permission\Handlers\Menu\SearchHandler;
use CrCms\Permission\Handlers\Menu\ShowHandler;
use CrCms\Permission\Handlers\Menu\StoreHandler;
use CrCms\Permission\Handlers\Menu\UpdateHandler;
use CrCms\Permission\Models\MenuModel;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use CrCms\Permission\Tests\ApplicationTrait;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

/**
 * Class MenuTest
 * @package CrCms\Permission\Tests\Menu
 */
class MenuTest extends TestCase
{
    use ApplicationTrait;

    public function testParentIdIsEmptyStore()
    {
        $handler = new StoreHandler();

        $data = [
            'title' => Str::random(10),
            'url' => Str::random(10),
            'route' => Str::random(10),
            'remark' => Str::random(255),
            'sort' => mt_rand(0, 1000),
            'status' => CommonConstant::STATUS_NORMAL,
            'parent_id' => '',
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(MenuModel::class, $result);
        $this->assertEquals($data['title'], $result->title);
        $this->assertEquals($data['url'], $result->url);
        $this->assertEquals($data['route'], $result->route);
        $this->assertEquals($data['sort'], $result->sort);
        $this->assertEquals($data['status'], $result->status);
        $this->assertEquals(true, is_null($result->parent_id));

        return $result;
    }

    public function testStore()
    {
        $handler = new StoreHandler();

        $data = [
            'title' => Str::random(10),
            'url' => Str::random(10),
            'route' => Str::random(10),
            'remark' => Str::random(255),
            'sort' => mt_rand(0, 1000),
            'status' => CommonConstant::STATUS_NORMAL,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(MenuModel::class, $result);
        $this->assertEquals($data['title'], $result->title);
        $this->assertEquals($data['url'], $result->url);
        $this->assertEquals($data['route'], $result->route);
        $this->assertEquals($data['sort'], $result->sort);
        $this->assertEquals($data['status'], $result->status);

        return $result;
    }

//
//    public function testList()
//    {
//        $handler = new ListHandler();
//
//        $data = [
//            'filter' => ['id', 'title', 'url', 'route', 'status_text', 'parent_id', 'created_at'],
//        ];
//
//        $result = $handler->handle(new DataProvider($data));
//
//        $this->assertInternalType('array', $result);
//    }
//
//    public function testGetList()
//    {
//        $handler = new SearchHandler();
//
//        $data = [
//            'filter' => ['id', 'title', 'parent_id']
//        ];
//
//        $result = $handler->handle(new DataProvider($data));
//
//        $this->assertInternalType('array', $result);
//    }
//
    /**
     * @depends testStore
     */
    public function testShow(MenuModel $menu)
    {
        $handler = new ShowHandler();

        $data = [
            'menu' => $menu->id,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(MenuModel::class, $result);
        $this->assertEquals($menu->title, $result->title);
        $this->assertEquals($menu->url, $result->url);
        $this->assertEquals($menu->route, $result->route);
        $this->assertEquals($menu->sort, $result->sort);
        $this->assertEquals($menu->status, $result->status);
    }

    /**
     * @depends testStore
     */
    public function testUpdate(MenuModel $menu)
    {
        $handler = new UpdateHandler();

        $data = [
            'title' => Str::random(10),
            'url' => Str::random(10),
            'route' => Str::random(20),
            'remark' => Str::random(255),
            'sort' => mt_rand(0, 1000),
            'menu' => $menu->id,
            'parent_id' => null,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertInstanceOf(MenuModel::class, $result);
        $this->assertEquals($data['title'], $result->title);
        $this->assertEquals($data['url'], $result->url);
        $this->assertEquals($data['route'], $result->route);
        $this->assertEquals($data['sort'], $result->sort);
    }

    /**
     * @depends testStore
     */
    public function testDestroy(MenuModel $menu)
    {
        $handler = new DestroyHandler();

        $data = [
            'menu' => $menu->id,
        ];

        $result = $handler->handle(new DataProvider($data));

        $this->assertEquals(1, $result);
    }
}
