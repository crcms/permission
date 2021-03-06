<?php

namespace CrCms\Permission\Tests\Permission;

use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;
use Illuminate\Validation\Validator;
use Illuminate\Translation\Translator;
use Illuminate\Translation\ArrayLoader;
use CrCms\Permission\Tests\ApplicationTrait;
use CrCms\Permission\Http\DataProviders\Permission\StoreDataProvider;

class PermissionDataProviderTest extends TestCase
{
    use ApplicationTrait;

    public function testPermissionStoreOrUpdateSuccess()
    {
        $verifier = app()->make('validation.presence');
        $trans = $this->getIlluminateArrayTranslator();
        $data = [
            'route' => 'afdafa',
            'action' => 'GET',
            'status' => 1,
            'title' => Str::random(10),
            'remark' => Str::random(255),
            'tags' => 'abc',
        ];

        $provider = new StoreDataProvider();

        $rules = $provider->rules();
        $messages = $provider->attributes();

        $v = new Validator($trans, $data, $rules, $messages);
        $v->setPresenceVerifier($verifier);
        $this->assertTrue($v->passes());
    }

    public function testPermissionStoreOrUpdateFail()
    {
        $verifier = app()->make('validation.presence');
        $trans = $this->getIlluminateArrayTranslator();
        $data = [
            'route' => 'afdafa',
            'action' => 'xxxx',
            'status' => 132,
            'title' => Str::random(10),
            'remark' => Str::random(255),
            'tags' => 'abc',
        ];

        $provider = new StoreDataProvider();

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
