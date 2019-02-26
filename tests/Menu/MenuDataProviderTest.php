<?php

namespace CrCms\Permission\Tests\Menu;

use CrCms\Permission\Http\DataProviders\Menu\StoreDataProvider;
use CrCms\Permission\Http\DataProviders\Menu\UpdateDataProvider;
use CrCms\Permission\Tests\ApplicationTrait;
use Illuminate\Support\Str;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Validator;
use PHPUnit\Framework\TestCase;

class MenuDataProviderTest extends TestCase
{
    use ApplicationTrait;

    public function testMenuStoreOrUpdateSuccess()
    {
        $verifier = app()->make('validation.presence');
        $trans = $this->getIlluminateArrayTranslator();
        $data = [
            'title' => Str::random(10),
            'url' => Str::random(10),
            'route' => Str::random(20),
            'status' => 1,
            'sort' => mt_rand(1, 100),
            'pid' => mt_rand(1, 100),
            'remark' => Str::random(255),
            'parent_id' => null,
        ];

        $provider = new StoreDataProvider();

        $rules = $provider->rules();
        $messages = $provider->attributes();

        $v = new Validator($trans, $data, $rules, $messages);
        $v->setPresenceVerifier($verifier);

        $this->assertTrue($v->passes());
    }

    public function testMenuStoreOrUpdateFail()
    {
        $verifier = app()->make('validation.presence');
        $trans = $this->getIlluminateArrayTranslator();
        $data = [
            'title' => Str::random(10),
            'url' => Str::random(10),
            'route' => Str::random(20),
            'status' => Str::random(20),
            'sort' => Str::random(10),
            'pid' => mt_rand(1, 100),
            'remark' => Str::random(255),
            'parent_id' => null,
        ];

        $provider = new UpdateDataProvider();

        $rules = $provider->rules();
        $messages = $provider->attributes();

        $v = new Validator($trans, $data, $rules, $messages);
        $v->setPresenceVerifier($verifier);
        $this->assertFalse($v->passes());
    }

    public function getIlluminateArrayTranslator()
    {
        return new Translator(
            new ArrayLoader, 'en'
        );
    }
}
