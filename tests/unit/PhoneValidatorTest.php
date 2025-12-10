<?php

declare(strict_types=1);

namespace udokmeci\yii2PhoneValidator\Tests\Unit;

use PHPUnit\Framework\TestCase;
use udokmeci\yii2PhoneValidator\PhoneValidator;
use udokmeci\yii2PhoneValidator\PhoneNumberFormat;
use yii\base\DynamicModel;

class PhoneValidatorTest extends TestCase
{
    protected function setUp(): void
    {
        if (!class_exists('\Yii')) {
            $this->markTestSkipped('Yii framework not available');
        }
    }

    public function testValidNetherlandsPhoneNumber(): void
    {
        $model = new DynamicModel(['phone']);
        $model->phone = '0612345678';
        
        $validator = new PhoneValidator(['country' => 'NL']);
        $validator->validateAttribute($model, 'phone');
        
        $this->assertEmpty($model->getErrors('phone'));
        $this->assertEquals('+31 6 12345678', $model->phone);
    }

    public function testValidTurkishPhoneNumber(): void
    {
        $model = new DynamicModel(['phone']);
        $model->phone = '5551234567';
        
        $validator = new PhoneValidator(['country' => 'TR']);
        $validator->validateAttribute($model, 'phone');
        
        $this->assertEmpty($model->getErrors('phone'));
        $this->assertEquals('+90 555 123 45 67', $model->phone);
    }

    public function testInvalidPhoneNumber(): void
    {
        $model = new DynamicModel(['phone']);
        $model->phone = '123';
        
        $validator = new PhoneValidator(['country' => 'NL']);
        $validator->validateAttribute($model, 'phone');
        
        $this->assertNotEmpty($model->getErrors('phone'));
    }

    public function testPhoneNumberFormatting(): void
    {
        $model = new DynamicModel(['phone']);
        $model->phone = '5551234567';
        
        $validator = new PhoneValidator([
            'country' => 'TR',
            'format' => PhoneNumberFormat::INTERNATIONAL
        ]);
        $validator->validateAttribute($model, 'phone');
        
        $this->assertEquals('+90 555 123 45 67', $model->phone);
    }

    public function testCountryAttributeDetection(): void
    {
        $model = new DynamicModel(['phone', 'country_code']);
        $model->phone = '0612345678';
        $model->country_code = 'NL';
        
        $validator = new PhoneValidator(['countryAttribute' => 'country_code']);
        $validator->validateAttribute($model, 'phone');
        
        $this->assertEmpty($model->getErrors('phone'));
        $this->assertEquals('+31 6 12345678', $model->phone);
    }

    public function testStrictModeWithoutCountry(): void
    {
        $model = new DynamicModel(['phone']);
        $model->phone = '0612345678';
        
        $validator = new PhoneValidator(['strict' => true]);
        $validator->validateAttribute($model, 'phone');
        
        $this->assertNotEmpty($model->getErrors('phone'));
    }

    public function testNonStrictModeWithoutCountry(): void
    {
        $model = new DynamicModel(['phone']);
        $model->phone = '0612345678';
        
        $validator = new PhoneValidator(['strict' => false]);
        $validator->validateAttribute($model, 'phone');
        
        $this->assertEmpty($model->getErrors('phone'));
    }

    public function testE164Format(): void
    {
        $model = new DynamicModel(['phone']);
        $model->phone = '0612345678';
        
        $validator = new PhoneValidator([
            'country' => 'NL',
            'format' => PhoneNumberFormat::E164
        ]);
        $validator->validateAttribute($model, 'phone');
        
        $this->assertEmpty($model->getErrors('phone'));
        $this->assertEquals('+31612345678', $model->phone);
    }

    public function testNoFormatting(): void
    {
        $model = new DynamicModel(['phone']);
        $model->phone = '0612345678';
        
        $validator = new PhoneValidator([
            'country' => 'NL',
            'format' => false
        ]);
        $validator->validateAttribute($model, 'phone');
        
        $this->assertEmpty($model->getErrors('phone'));
        $this->assertEquals('0612345678', $model->phone);
    }

    public function testEnumE164Format(): void
    {
        $model = new DynamicModel(['phone']);
        $model->phone = '0612345678';
        
        $validator = new PhoneValidator([
            'country' => 'NL',
            'format' => PhoneNumberFormat::E164
        ]);
        $validator->validateAttribute($model, 'phone');
        
        $this->assertEmpty($model->getErrors('phone'));
        $this->assertEquals('+31612345678', $model->phone);
    }

    public function testEnumNationalFormat(): void
    {
        $model = new DynamicModel(['phone']);
        $model->phone = '0612345678';
        
        $validator = new PhoneValidator([
            'country' => 'NL',
            'format' => PhoneNumberFormat::NATIONAL
        ]);
        $validator->validateAttribute($model, 'phone');
        
        $this->assertEmpty($model->getErrors('phone'));
        $this->assertEquals('06 12345678', $model->phone);
    }
}