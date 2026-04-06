<?php

namespace App\Models;

use App\Traits\BelongsToGym;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use BelongsToGym;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization',
        'salary',
    ];

    public function members()
{
    return $this->hasMany(Member::class);
}
}
