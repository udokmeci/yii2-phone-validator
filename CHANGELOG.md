# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2024-12-10

### Added
- Modern PHP 8.1+ enum for PhoneNumberFormat with type safety
- Comprehensive test suite with PHPUnit (11 tests, 18 assertions)
- Static analysis with PHPStan (level 8, 0 errors)
- Code style enforcement with PHP_CodeSniffer (PSR-12)
- Internationalization support with Bootstrap class
- Multi-language error messages (English, Turkish, Dutch)
- Enhanced documentation and usage examples
- Database integration patterns and search model examples
- Automatic phone number formatting (INTERNATIONAL default)
- Enhanced country detection with fallback strategies
- Non-strict mode for optional country validation

### Changed
- **BREAKING**: Minimum PHP version now 8.1+
- **BREAKING**: Updated to Yii2 2.0.40+
- **BREAKING**: Updated libphonenumber-for-php to 8.13+
- Restructured codebase following Yii2 extension guidelines
- PhoneNumberFormat converted from class constants to backed enum
- Enhanced type annotations and IDE support
- Cleaner dependency management (users only depend on this package)
- Modernized code with strict types and improved error handling

### Fixed
- Fixed homepage URL in composer.json
- Improved country code detection logic
- Better exception handling and validation
- Internationalized error messages

### Removed
- Legacy folder structure `src/udokmeci/yii2PhoneValidator/`
- Outdated dependencies and configurations

### Migration Guide
- Update composer.json to require PHP ^8.1 and yiisoft/yii2 ^2.0.40
- Import PhoneNumberFormat from new namespace: `use udokmeci\yii2PhoneValidator\PhoneNumberFormat;`
- Existing integer format values continue to work (backward compatible)
- Consider migrating to enum usage for better type safety

## [1.0.4] - Previous releases
- Legacy PHP 5.3+ support
- Basic phone validation functionality