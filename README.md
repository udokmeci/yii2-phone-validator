# Yii2 Phone Validator

[![Tests](https://github.com/udokmeci/yii2-phone-validator/workflows/Tests/badge.svg)](https://github.com/udokmeci/yii2-phone-validator/actions)
[![Code Quality](https://github.com/udokmeci/yii2-phone-validator/workflows/Code%20Quality/badge.svg)](https://github.com/udokmeci/yii2-phone-validator/actions)
[![Latest Stable Version](https://poser.pugx.org/udokmeci/yii2-phone-validator/v/stable)](https://packagist.org/packages/udokmeci/yii2-phone-validator)
[![Total Downloads](https://poser.pugx.org/udokmeci/yii2-phone-validator/downloads)](https://packagist.org/packages/udokmeci/yii2-phone-validator)
[![License](https://poser.pugx.org/udokmeci/yii2-phone-validator/license)](https://packagist.org/packages/udokmeci/yii2-phone-validator)
[![PHP Version](https://img.shields.io/badge/php-%5E8.1-blue)](https://php.net/)

Yii2 phone number validator extension using Google's libphonenumber library.

## Installation

```bash
composer require udokmeci/yii2-phone-validator
```

## Usage

### Basic Validation

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

### Using Format Enum

```php
use udokmeci\yii2PhoneValidator\PhoneValidator;
use udokmeci\yii2PhoneValidator\PhoneNumberFormat;

// Modern PHP 8.1+ enum usage
public function rules()
{
    return [
        [['phone'], PhoneValidator::class, 
            'country' => 'NL',
            'format' => PhoneNumberFormat::E164        // Enum case
        ],
        [['mobile'], PhoneValidator::class,
            'country' => 'NL', 
            'format' => PhoneNumberFormat::INTERNATIONAL // Enum case
        ],
    ];
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
            'format' => PhoneNumberFormat::E164  // Using enum
        ],
    ];
}
```

## Configuration

| Property | Description | Default |
|----------|-------------|---------|
| `country` | Fixed country code (ISO 3166-1 alpha-2) | `null` |
| `countryAttribute` | Model attribute containing country code | `null` |
| `strict` | Require country for validation | `true` |
| `format` | Output format | `INTERNATIONAL` |

## Format Options

| Format | Example Output |
|--------|----------------|
| `PhoneNumberFormat::E164` | `+31612345678` |
| `PhoneNumberFormat::INTERNATIONAL` | `+31 6 12345678` |
| `PhoneNumberFormat::NATIONAL` | `06 12345678` |
| `PhoneNumberFormat::RFC3966` | `tel:+31-6-12345678` |
| `false` | No formatting |

**Note:** `PhoneNumberFormat` is a modern PHP 8.1+ enum. Import: `use udokmeci\yii2PhoneValidator\PhoneNumberFormat;`

## Examples

### Netherlands Phone
```php
// Input: '0612345678'
// Output: '+31 6 12345678'
```

### US Phone
```php
[['phone'], PhoneValidator::class, 'country' => 'US']
// Input: '2125551234' 
// Output: '+1 212 555 1234'
```

### Non-Strict Mode
```php
[['phone'], PhoneValidator::class, 'strict' => false]
// Validates only if country is available
```

## Requirements

- PHP 8.1+
- Yii2 2.0.40+  
- giggsey/libphonenumber-for-php ^8.13

## Testing

Follow [Yii2 Extension Testing Guidelines](https://www.yiiframework.com/doc/guide/2.0/en/structure-extensions#testing):

```bash
vendor/bin/phpunit
vendor/bin/phpstan analyse  
vendor/bin/phpcs --standard=PSR12 src/
```

## License

MIT License. See [LICENSE](LICENSE) file.
