<?php

declare(strict_types=1);

namespace udokmeci\yii2PhoneValidator;

use yii\validators\Validator;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;
use Exception;
use Yii;

/**
 * Phone validator class that validates phone numbers for given
 * country and formats.
 * Country codes and attributes value should be ISO 3166-1 alpha-2 codes
 *
 * @author Uğur DÖKMECİ <ugurdokmeci@gmail.com>
 * @license MIT
 */
class PhoneValidator extends Validator
{
    public bool $strict = true;
    public ?string $countryAttribute = null;
    public ?string $country = null;
    public bool|int|PhoneNumberFormat $format = PhoneNumberFormat::INTERNATIONAL;

    /**
     * Validates a phone number attribute.
     */
    public function validateAttribute($model, $attribute): void
    {
        $country = $this->getCountryCode($model);

        if ($country === null && $this->strict) {
            $this->addError(
                $model,
                $attribute,
                Yii::t('phone-validator', 'For phone validation country required')
            );
            return;
        }

        if ($country === null) {
            return;
        }

        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $numberProto = $phoneUtil->parse($model->$attribute, $country);
            if ($phoneUtil->isValidNumber($numberProto)) {
                if ($this->format !== false) {
                    $formatValue = $this->format instanceof PhoneNumberFormat
                        ? $this->format->toLibPhoneNumberFormat()
                        : $this->format;
                    if (is_int($formatValue)) {
                        $model->$attribute = $phoneUtil->format($numberProto, $formatValue);
                    }
                }
            } else {
                $this->addError(
                    $model,
                    $attribute,
                    Yii::t('phone-validator', 'Phone number does not seem to be a valid phone number')
                );
            }
        } catch (NumberParseException $e) {
            $this->addError(
                $model,
                $attribute,
                Yii::t('phone-validator', 'Unexpected Phone Number Format')
            );
        } catch (Exception $e) {
            $this->addError(
                $model,
                $attribute,
                Yii::t('phone-validator', 'Unexpected Phone Number Format or Country Code')
            );
        }
    }

    /**
     * Get country code from model or configuration.
     */
    private function getCountryCode(mixed $model): ?string
    {
        if ($this->countryAttribute !== null) {
            $countryAttribute = $this->countryAttribute;
            return $model->$countryAttribute ?? null;
        }

        if ($this->country !== null) {
            return $this->country;
        }

        if (isset($model->country_code)) {
            return $model->country_code;
        }

        if (isset($model->country)) {
            return $model->country;
        }

        return null;
    }
}
