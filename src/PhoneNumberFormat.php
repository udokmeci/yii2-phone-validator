<?php

/**
 * Phone number format enum for Yii2 Phone Validator.
 *
 * @author Uğur DÖKMECİ <ugurdokmeci@gmail.com>
 * @license MIT
 */

declare(strict_types=1);

namespace udokmeci\yii2PhoneValidator;

use libphonenumber\PhoneNumberFormat as LibPhoneNumberFormat;

/**
 * Phone number format enum backed by libphonenumber constants.
 *
 * @author Uğur DÖKMECİ <ugurdokmeci@gmail.com>
 * @license MIT
 */
enum PhoneNumberFormat: int
{
    /**
     * E.164 format: +905551234567
     */
    case E164 = 0;

    /**
     * International format: +90 555 123 45 67
     */
    case INTERNATIONAL = 1;

    /**
     * National format: 0555 123 45 67
     */
    case NATIONAL = 2;

    /**
     * RFC3966 format: tel:+90-555-123-45-67
     */
    case RFC3966 = 3;

    /**
     * Get the corresponding libphonenumber format constant.
     */
    public function toLibPhoneNumberFormat(): int
    {
        switch ($this) {
            case self::E164:
                return LibPhoneNumberFormat::E164;
            case self::INTERNATIONAL:
                return LibPhoneNumberFormat::INTERNATIONAL;
            case self::NATIONAL:
                return LibPhoneNumberFormat::NATIONAL;
            case self::RFC3966:
                return LibPhoneNumberFormat::RFC3966;
        }
    }
}
