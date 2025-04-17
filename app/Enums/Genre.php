<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;

enum Genre: string implements HasColor
{
    case ACTION = 'action';
    case ADVENTURE = 'adventure';
    case ANIMATION = 'animation';
    case COMEDY = 'comedy';
    case DOCUMENTARY = 'documentary';
    case DRAMA = 'drama';

    public function getColor(): string
    {
        return match ($this) {
            self::ACTION => 'danger',
            self::ADVENTURE => 'warning',
            self::ANIMATION => 'primary',
            self::COMEDY => 'success',
            self::DOCUMENTARY => 'secondary',
            self::DRAMA => 'info',
        };
    }
}
