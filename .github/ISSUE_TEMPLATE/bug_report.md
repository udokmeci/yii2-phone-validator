---
name: Bug report
about: Create a report to help us improve
title: '[BUG] '
labels: bug
assignees: udokmeci

---

## Bug Description
A clear and concise description of what the bug is.

## To Reproduce
Steps to reproduce the behavior:
1. Use validator with configuration: '...'
2. Validate phone number: '...'
3. Expected result: '...'
4. Actual result: '...'

## Expected Behavior
A clear and concise description of what you expected to happen.

## Environment
- PHP version: [e.g. 8.1.15]
- Yii2 version: [e.g. 2.0.45]
- Extension version: [e.g. 2.0.0]
- Country code: [e.g. TR, US, NL]
- Phone number format: [e.g. E164, INTERNATIONAL]

## Code Sample
```php
// Provide minimal code to reproduce the issue
$validator = new PhoneValidator([
    'country' => 'TR',
    'format' => PhoneNumberFormat::INTERNATIONAL
]);

$model = new DynamicModel(['phone']);
$model->phone = '5551234567';
$model->addRule('phone', $validator);
$result = $model->validate();
```

## Additional Context
Add any other context about the problem here.