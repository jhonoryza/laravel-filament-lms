<?php

namespace App\Enum;

enum CourseType: string
{
    case EBOOK = 'ebook';
    case KELAS = 'kelas';

    public static function toArray(): array
    {
        return collect(self::cases())->pluck('value')->toArray();
    }
}
