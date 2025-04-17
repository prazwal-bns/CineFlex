<?php

namespace App\Support;

final class Helper{

    // ->formatStateUsing(fn ($state) => Str::title("{$state} min"))

    public static function capitalizeString(string $value){
        return ucwords(str_replace(" ","", $value));
    }
}
