<?php

/**
 * Bootstrap class for Yii2 Phone Validator extension.
 *
 * @author Uğur DÖKMECİ <ugurdokmeci@gmail.com>
 */

namespace udokmeci\yii2PhoneValidator;

use yii\base\BootstrapInterface;
use yii\i18n\PhpMessageSource;

/**
 * Bootstrap class for automatic i18n configuration.
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * Bootstrap the extension by configuring i18n message sources.
     */
    public function bootstrap($app): void
    {
        if (!isset($app->i18n->translations['phone-validator'])) {
            $app->i18n->translations['phone-validator'] = [
                'class' => PhpMessageSource::class,
                'basePath' => __DIR__ . '/messages',
                'sourceLanguage' => 'en-US',
            ];
        }
    }
}
