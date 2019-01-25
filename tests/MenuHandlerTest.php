<?php

namespace CrCms\Permission\Tests;

use CrCms\Foundation\Transporters\DataProvider;
use CrCms\Permission\Handlers\Menu\ShowHandler;
use PHPUnit\Framework\TestCase;

class MenuHandlerTest extends TestCase
{

    public function setUp()
    {

    }

    public function testShow()
    {

        $handler = new ShowHandler();

        $result = $handler->handle(new DataProvider(['menu'=>1]));

        var_dump($result);
    }

    public function tearDown()
    {

    }
}