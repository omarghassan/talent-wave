<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    protected $fillable = ['user_id', 'start_date', 'end_date', 'status', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
