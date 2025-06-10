<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class TheaterManagerScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();

        // Only apply scope if user is a theater manager
        if ($user && $user->isTheaterManager()) {
            $builder->whereHas('theater', function ($query) use ($user) {
                $query->where('manager_id', $user->id);
            });
        }
    }
}
