<?php

namespace App\Enums;

enum MovieGenres: string
{
    case Action = 'Action';
    case Adventure = 'Adventure';
    case Animation = 'Animation';
    case Biography = 'Biography';
    case Comedy = 'Comedy';
    case Crime = 'Crime';
    case Documentary = 'Documentary';
    case Drama = 'Drama';
    case Family = 'Family';
    case Fantasy = 'Fantasy';
    case History = 'History';
    case Horror = 'Horror';
    case Musical = 'Musical';
    case Mystery = 'Mystery';
    case Romance = 'Romance';
    case SciFi = 'Sci-Fi';
    case Sport = 'Sport';
    case Thriller = 'Thriller';
    case War = 'War';
    case Western = 'Western';

    public function getLabel(): string
    {
        return match ($this) {
            self::Action => 'Action',
            self::Adventure => 'Adventure',
            self::Animation => 'Animation',
            self::Biography => 'Biography',
            self::Comedy => 'Comedy',
            self::Crime => 'Crime',
            self::Documentary => 'Documentary',
            self::Drama => 'Drama',
            self::Family => 'Family',
            self::Fantasy => 'Fantasy',
            self::History => 'History',
            self::Horror => 'Horror',
            self::Musical => 'Musical',
            self::Mystery => 'Mystery',
            self::Romance => 'Romance',
            self::SciFi => 'Sci-Fi',
            self::Sport => 'Sport',
            self::Thriller => 'Thriller',
            self::War => 'War',
            self::Western => 'Western',
        };
    }

   public function getColor(): string
    {
        return match ($this) {
            self::Action => 'danger',
            self::Adventure => 'orange',
            self::Animation => 'pink',
            self::Biography => 'teal',
            self::Comedy => 'yellow',
            self::Crime => 'indigo',
            self::Documentary => 'info',
            self::Drama => 'cyan',
            self::Family => 'lime',
            self::Fantasy => 'purple',
            self::History => 'warning',
            self::Horror => 'secondary',
            self::Musical => 'violet',
            self::Mystery => 'gray',
            self::Romance => 'rose',
            self::SciFi => 'purple',
            self::Sport => 'success',
            self::Thriller => 'gray',
            self::War => 'warning',
            self::Western => 'secondary',
        };
    }

}
