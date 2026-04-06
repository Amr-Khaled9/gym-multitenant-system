<?php

namespace App\Models;

use App\Traits\BelongsToGym;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use BelongsToGym;

    protected $fillable = [
        'member_id',
        'plan',
        'price',
        'start_date',
        'end_date',
        'status',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
