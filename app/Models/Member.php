<?php

namespace App\Models;

use App\Traits\BelongsToGym;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use BelongsToGym;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'gym_id'
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
