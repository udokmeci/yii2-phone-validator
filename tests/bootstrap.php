<?php

require_once __DIR__ . '/../vendor/autoload.php';

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

new \yii\console\Application([
    'id' => 'testapp',
    'basePath' => __DIR__,
    'vendorPath' => __DIR__ . '/../vendor',
    'components' => [
        'i18n' => [
            'translations' => [
                'phone-validator' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => __DIR__ . '/../src/messages',
                    'sourceLanguage' => 'en-US',
                ],
            ],
        ],
    ],
]);

Yii::setAlias('@tests', __DIR__);