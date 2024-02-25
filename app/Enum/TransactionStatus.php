<?php

namespace App\Enum;

enum TransactionStatus: string
{
    case SUCCESS = 'success';
    case PENDING = 'pending';
    case EXPIRED = 'expired';
    case FAILED = 'failed';

    public static function toArray(): array
    {
        return collect(self::cases())->pluck('value')->toArray();
    }
}
