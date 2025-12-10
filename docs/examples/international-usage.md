# International Usage Examples

## Multi-Country Business Model

```php
<?php
namespace app\models;

use yii\db\ActiveRecord;
use udokmeci\yii2PhoneValidator\PhoneValidator;
use udokmeci\yii2PhoneValidator\PhoneNumberFormat;

class Business extends ActiveRecord
{
    public function rules()
    {
        return [
            [['main_phone'], PhoneValidator::class,
                'countryAttribute' => 'country',
                'format' => PhoneNumberFormat::INTERNATIONAL
            ],
            [['mobile_phone'], PhoneValidator::class,
                'countryAttribute' => 'country', 
                'format' => PhoneNumberFormat::E164
            ],
        ];
    }
    
    public function getFormattedMainPhone()
    {
        return $this->main_phone;
    }
    
    public function getCallablePhone()
    {
        return $this->mobile_phone;
    }
}
```

## Format Helper

```php
<?php
namespace app\helpers;

use libphonenumber\PhoneNumberUtil;
use udokmeci\yii2PhoneValidator\PhoneNumberFormat;

class PhoneHelper
{
    public static function format($phone, $country, $format = PhoneNumberFormat::INTERNATIONAL)
    {
        if (empty($phone) || empty($country)) {
            return $phone;
        }
        
        try {
            $phoneUtil = PhoneNumberUtil::getInstance();
            $numberProto = $phoneUtil->parse($phone, $country);
            
            if ($phoneUtil->isValidNumber($numberProto)) {
                // Convert enum to integer if necessary
                $formatValue = is_object($format) && method_exists($format, 'toLibPhoneNumberFormat')
                    ? $format->toLibPhoneNumberFormat()
                    : $format;
                return $phoneUtil->format($numberProto, $formatValue);
            }
        } catch (\Exception $e) {
            // Return original on error
        }
        
        return $phone;
    }
    
    public static function createLink($phone, $country = null)
    {
        $e164 = self::format($phone, $country, PhoneNumberFormat::E164);
        $display = self::format($phone, $country, PhoneNumberFormat::INTERNATIONAL);
        
        return "<a href=\"tel:$e164\">$display</a>";
    }
}
```

## Country Examples

### Netherlands (NL)
```php
class ContactNL extends ActiveRecord
{
    public function rules()
    {
        return [
            [['phone'], PhoneValidator::class, 'country' => 'NL'],
        ];
    }
}

// Input: 0612345678
// Output: +31 6 12345678
```

### United States (US)
```php
class ContactUS extends ActiveRecord
{
    public function rules()
    {
        return [
            [['phone'], PhoneValidator::class, 'country' => 'US'],
        ];
    }
}

// Input: 2125551234
// Output: +1 212 555 1234
```

### Turkey (TR)
```php
class ContactTR extends ActiveRecord
{
    public function rules()
    {
        return [
            [['phone'], PhoneValidator::class, 'country' => 'TR'],
        ];
    }
}

// Input: 5551234567
// Output: +90 555 123 45 67
```

## Dynamic Country Selection

```php
class MultiCountryContact extends ActiveRecord
{
    public function rules()
    {
        return [
            [['phone'], PhoneValidator::class,
                'countryAttribute' => 'country_code'
            ],
            [['country_code'], 'in', 'range' => ['NL', 'US', 'TR', 'GB', 'DE']],
        ];
    }
}
```