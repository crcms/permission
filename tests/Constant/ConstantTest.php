<?php

namespace CrCms\Permission\Tests\Constant;

use CrCms\Foundation\Transporters\DataProvider;
use CrCms\Permission\Handlers\Constant\SearchHandler;
use CrCms\Permission\Tests\ApplicationTrait;
use PHPUnit\Framework\TestCase;

class ConstantTest extends TestCase
{
    use ApplicationTrait;

    public function testGetConstant()
    {
        $handler = new SearchHandler();

        $data = [];

        $result = $handler->handle(new DataProvider($data));

        $this->assertEquals(true,is_array($result));
        $this->assertArrayHasKey('CommonConstant', $result);
    }
}
