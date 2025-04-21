<?php

namespace App\Support;

final class Helper
{

    // ->formatStateUsing(fn ($state) => Str::title("{$state} min"))

    public static function capitalizeString(string $value)
    {
        return ucwords(str_replace(" ", "", $value));
    }

    public static function upperString(string $value)
    {
        return strtoupper($value);
    }

    public static function applyTheaterManagerFilter($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', 'theater_manager');
        });
    }
}
