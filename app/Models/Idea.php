<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Idea extends Model
{
    protected $guarded = [];

    // Initial attribute for 'state'
    protected $attributes = [
        'state' =>'pending',
    ];

    /**
     * if we call user on $idea ($idea->user) it gives us the object of the user who created it.
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
