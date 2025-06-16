<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait SortsByLatest
{
    public static function bootSortsByLatest()
    {
        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->orderByDesc(static::getModelTable() . '.created_at');
        });
    }

    protected static function getModelTable()
    {
        return (new static)->getTable();
    }
}
