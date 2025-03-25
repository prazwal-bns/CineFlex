<?php

namespace App\Enums;

enum OrganizationType: string
{
    case SUPERADMIN = 'superadmin';
    case THEATER_MANAGER = 'theater_manager';
    case CUSTOMER = 'customer';

    public function label(): string
    {
        return match ($this) {
            self::SUPERADMIN => 'Super Admin',
            self::THEATER_MANAGER => 'Theater Manager',
            self::CUSTOMER => 'Customer',
        };
    }

    public static function labels(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }

    public static function getDefault(): self
    {
        return self::CUSTOMER;
    }
}
