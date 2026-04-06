<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait BelongsToGym
{

    protected static function booted()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->gym_id = Auth::user()->gym_id;
            }
        });

        static::addGlobalScope('gym', function (Builder $builder) {
            if (Auth::check()) {
                $builder->where('gym_id', Auth::user()->gym_id);
            }
        });
    }
}
