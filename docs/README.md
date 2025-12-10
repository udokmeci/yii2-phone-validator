# Yii2 Phone Validator Documentation

Comprehensive phone number validation extension for Yii2 framework using Google's libphonenumber library.

## Installation

```bash
composer require udokmeci/yii2-phone-validator
```

## Basic Usage

### Simple Validation
```php
use udokmeci\yii2PhoneValidator\PhoneValidator;

class Contact extends ActiveRecord
{
    public function rules()
    {
        return [
            [['phone'], PhoneValidator::class, 'country' => 'NL'],
        ];
    }
}
```

### Dynamic Country Detection
```php
public function rules()
{
    return [
        [['phone'], PhoneValidator::class, 'countryAttribute' => 'country_code'],
    ];
}
```

### Custom Formatting
```php
use udokmeci\yii2PhoneValidator\PhoneNumberFormat;

public function rules()
{
    return [
        [['phone'], PhoneValidator::class, 
            'country' => 'NL',
            'format' => PhoneNumberFormat::E164  // Enum case
        ],
    ];
}
```

## Configuration Options

### Properties

- `country` - Fixed country code (ISO 3166-1 alpha-2)
- `countryAttribute` - Model attribute containing country code  
- `strict` - Require country code for validation (default: true)
- `format` - Phone number format output (default: INTERNATIONAL)

### Format Constants

| Format | Enum Case | Example Output |
|--------|-----------|----------------|
| E164 | `PhoneNumberFormat::E164` | `+31612345678` |
| International | `PhoneNumberFormat::INTERNATIONAL` | `+31 6 12345678` |
| National | `PhoneNumberFormat::NATIONAL` | `06 12345678` |
| RFC3966 | `PhoneNumberFormat::RFC3966` | `tel:+31-6-12345678` |

## Testing

Extension follows Yii2 testing guidelines. See [Yii2 Extension Testing](https://www.yiiframework.com/doc/guide/2.0/en/structure-extensions#testing) for details.

```bash
vendor/bin/phpunit
vendor/bin/phpstan analyse
vendor/bin/phpcs --standard=PSR12 src/
```

## Country Examples

Common ISO 3166-1 alpha-2 codes:
- `NL` - Netherlands  
- `US` - United States
- `TR` - Turkey
- `GB` - United Kingdom
- `DE` - Germany
- `FR` - France