<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    protected $fillable = [
        'name',
        'address',
        'city',
        'manager_id',
    ];
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function screens()
    {
        return $this->hasMany(Screen::class);
    }
}
