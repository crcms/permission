<?php

namespace CrCms\Permission\Tests\Field;

use CrCms\Permission\Http\DataProviders\Field\StoreDataProvider;
use CrCms\Permission\Tests\ApplicationTrait;
use Illuminate\Support\Str;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Validator;
use PHPUnit\Framework\TestCase;

class FieldDataProviderTest extends TestCase
{
    use ApplicationTrait;

    public function testFieldStoreOrUpdateSuccess()
    {
        $verifier = app()->make('validation.presence');
        $trans = $this->getIlluminateArrayTranslator();
        $data = [
            'table_name' => Str::random(10),
            'field' => Str::random(10),
            'name' => Str::random(10),
        ];

        $provider = new StoreDataProvider();

        $rules = $provider->rules();
        $messages = $provider->attributes();

        $v = new Validator($trans, $data, $rules, $messages);
        $v->setPresenceVerifier($verifier);
        $this->assertTrue($v->passes());
    }

    public function testFieldStoreOrUpdateFail()
    {
        $verifier = app()->make('validation.presence');
        $trans = $this->getIlluminateArrayTranslator();
        $data = [
            'table_name' => Str::random(10),
            'field' => mt_rand(1, 100),
            'name' => Str::random(288),
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