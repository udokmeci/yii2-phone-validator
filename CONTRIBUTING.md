# Contributing to Yii2 Phone Validator

Thank you for your interest in contributing to the Yii2 Phone Validator! This document provides guidelines and instructions for contributing.

## Code of Conduct

This project follows a simple code of conduct: be respectful, constructive, and professional in all interactions.

## Development Setup

### Prerequisites
- PHP 8.1 or higher
- Composer
- Git

### Installation
```bash
# Clone the repository
git clone https://github.com/udokmeci/yii2-phone-validator.git
cd yii2-phone-validator

# Install dependencies
composer install

# Run tests to ensure everything works
vendor/bin/phpunit
vendor/bin/phpstan analyse
vendor/bin/phpcs
```

## Development Workflow

### 1. Fork and Branch
```bash
# Fork the repository on GitHub
# Clone your fork
git clone https://github.com/YOUR_USERNAME/yii2-phone-validator.git
cd yii2-phone-validator

# Create a feature branch
git checkout -b feature/your-feature-name
```

### 2. Make Changes
- Write clean, well-documented code
- Follow PSR-12 coding standards
- Add type hints where appropriate
- Write or update tests for new functionality

### 3. Quality Checks
Before submitting, ensure all quality checks pass:
```bash
# Run tests
vendor/bin/phpunit

# Static analysis
vendor/bin/phpstan analyse

# Code style
vendor/bin/phpcs

# Fix code style issues
vendor/bin/phpcbf
```

### 4. Commit Guidelines
Use clear, descriptive commit messages:
```bash
# Good examples:
git commit -m "Add support for Nigerian phone numbers"
git commit -m "Fix validation error for numbers with country prefix"
git commit -m "Update documentation for new enum usage"

# Bad examples:
git commit -m "fix bug"
git commit -m "update code"
```

### 5. Submit Pull Request
- Push your branch to your fork
- Create a Pull Request against the `master` branch
- Fill out the PR template completely
- Ensure CI checks pass

## Coding Standards

### PHP Standards
- Follow PSR-12 coding standards
- Use strict typing: `declare(strict_types=1);`
- Add proper PHPDoc blocks
- Use meaningful variable and method names

### Example Code Style
```php
<?php

declare(strict_types=1);

namespace udokmeci\yii2PhoneValidator;

use yii\validators\Validator;

/**
 * Phone number validator for Yii2 applications.
 */
class PhoneValidator extends Validator
{
    /**
     * Validates the phone number format.
     */
    public function validateAttribute($model, string $attribute): void
    {
        // Implementation
    }
}
```

### Testing
- Write unit tests for new functionality
- Maintain or improve test coverage
- Test edge cases and error conditions
- Use descriptive test method names

```php
public function testValidateTurkishPhoneNumber(): void
{
    // Test implementation
}

public function testInvalidPhoneNumberReturnsError(): void
{
    // Test implementation
}
```

## Documentation

### Code Documentation
- Add PHPDoc blocks for all public methods
- Document parameters, return types, and exceptions
- Include usage examples for complex features

### User Documentation
- Update README.md for new features
- Add examples to docs/ folder
- Update CHANGELOG.md following Keep a Changelog format

## Release Process

Releases follow semantic versioning (SemVer):
- **MAJOR** version for incompatible API changes
- **MINOR** version for backwards-compatible functionality additions  
- **PATCH** version for backwards-compatible bug fixes

### CHANGELOG.md Format
```markdown
## [2.1.0] - 2024-12-15

### Added
- New feature description

### Changed  
- Changed behavior description

### Fixed
- Bug fix description
```

## Testing

### Running Tests
```bash
# Run all tests
vendor/bin/phpunit

# Run with coverage
vendor/bin/phpunit --coverage-html coverage/

# Run specific test
vendor/bin/phpunit tests/unit/PhoneValidatorTest.php
```

### Writing Tests
- Place tests in `tests/unit/`
- Extend `PHPUnit\Framework\TestCase`
- Test both success and failure scenarios
- Use data providers for multiple test cases

## Issue Reporting

When reporting issues:
1. Use the provided issue templates
2. Include environment details (PHP version, Yii2 version, etc.)
3. Provide minimal code to reproduce the issue
4. Include expected vs actual behavior

## Getting Help

- Review existing documentation and examples
- Check closed issues for similar problems
- Open a new issue with the question template
- Be specific about your use case and environment

## Recognition

Contributors will be acknowledged in:
- CHANGELOG.md for significant contributions
- README.md contributors section
- GitHub contributors page

Thank you for contributing!