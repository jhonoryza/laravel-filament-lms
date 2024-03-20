<?php

namespace App\Enum;

enum MidtransPaymentStatus: string
{
    case SUCCESS    = 'success';
    case CAPTURE    = 'capture';
    case SETTLEMENT = 'settlement';
    case PENDING    = 'pending';
    case CANCEL     = 'cancel';
    case EXPIRED    = 'expired';
    case EXPIRE     = 'expire';

    public function isSuccess(): bool
    {
        return in_array($this->name, [self::SUCCESS, self::CAPTURE, self::SETTLEMENT]);
    }

    public function isShouldCancel(): bool
    {
        return in_array($this->name, [self::CANCEL, self::EXPIRED, self::EXPIRE]);
    }

    public static function toArray(): array
    {
        return collect(self::cases())->pluck('value')->toArray();
    }
}
