<?php

namespace CrCms\Permission\Tests\Constant;

use PHPUnit\Framework\TestCase;
use CrCms\Permission\Tests\ApplicationTrait;
use CrCms\Foundation\Transporters\DataProvider;
use CrCms\Permission\Handlers\Constant\SearchHandler;

class ConstantTest extends TestCase
{
    use ApplicationTrait;

    public function testGetConstant()
    {
        $handler = new SearchHandler();

        $data = [];

        $result = $handler->handle(new DataProvider($data));

        $this->assertEquals(true, is_array($result));
        $this->assertArrayHasKey('CommonConstant', $result);
    }
}
