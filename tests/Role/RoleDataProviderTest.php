<?php

namespace CrCms\Permission\Tests\Role;

use PHPUnit\Framework\TestCase;
use Illuminate\Validation\Validator;
use Illuminate\Translation\Translator;
use Illuminate\Translation\ArrayLoader;
use CrCms\Permission\Tests\ApplicationTrait;
use CrCms\Permission\Http\DataProviders\Role\StoreDataProvider;

class RoleDataProviderTest extends TestCase
{
    use ApplicationTrait;

    public function testStoreOrUpdateDataProviderSuccess()
    {
        $verifier = app()->make('validation.presence');
        $trans = $this->getIlluminateArrayTranslator();
        $data = [
            'name' => 'afdafa',
            'remark' => 'xxxxx',
            'status' => 1,
            'super' => 1,
        ];
        $provider = new StoreDataProvider();

        $rules = $provider->rules();
        $messages = $provider->attributes();
        $v = new Validator($trans, $data, $rules, $messages);
        $v->setPresenceVerifier($verifier);
        $this->assertTrue($v->passes());
    }

    public function testStoreOrUpdateDataProviderFail()
    {
        $verifier = app()->make('validation.presence');
        $trans = $this->getIlluminateArrayTranslator();
        $data = [
            'name' => 123412,
            'remark' => 'xxxxx',
            'status' => 11,
            'super' => 12,
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
