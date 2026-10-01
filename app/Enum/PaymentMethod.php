<?php

namespace App\Enum;

enum PaymentMethod: string
{
    case MIDTRANS = 'midtrans';

    public static function toArray(): array
    {
        return collect(self::cases())->pluck('value')->toArray();
    }
}
