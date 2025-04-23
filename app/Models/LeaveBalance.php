<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    /** @use HasFactory<\Database\Factories\LeaveBalanceFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leave_type_id',
        'year',
        'allocated',
        'used',
        'remaining',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class);
    }
}
