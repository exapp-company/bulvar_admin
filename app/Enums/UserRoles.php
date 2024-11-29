<?php

namespace App\Enums;

use App\Contracts\EnumContract;
use App\Traits\Enumerable;

enum UserRoles implements EnumContract
{
    use Enumerable;

    private const admin = 'admin';
    private const content = 'content';
    private const seo = 'seo';



    public static function readable(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        return match ($value) {
            self::admin => 'Администратор',
            self::content => 'Контент',
            self::seo => 'СЕО',
            default => null,
        };
    }

    public static function default(): string
    {
        return self::admin;
    }
}
