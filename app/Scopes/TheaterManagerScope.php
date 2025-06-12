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

        if ($user && $user->isTheaterManager()) {
            $table = $model->getTable();

            switch ($table) {
                case 'theaters':
                    $builder->where('manager_id', $user->id);
                    break;

                case 'screens':
                    if (method_exists($model, 'theater')) {
                        $builder->whereHas('theater', function ($query) use ($user) {
                            $query->where('manager_id', $user->id);
                        });
                    }
                    break;

                case 'seats':
                    if (method_exists($model, 'screen')) {
                        $builder->whereHas('screen.theater', function ($query) use ($user) {
                            $query->where('manager_id', $user->id);
                        });
                    }
                    break;

                default:
                    // Optional fallback if other models are added
                    break;
            }
        }
    }
}

