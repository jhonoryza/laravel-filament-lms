<?php

namespace App\Enum;

enum CourseType: string
{
    case EBOOK = 'ebook';
    case KELAS = 'kelas';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return collect(self::toArray())->mapWithKeys(fn($type) => [$type => ucwords($type)])->toArray();
    }
}
