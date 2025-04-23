<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    /** @use HasFactory<\Database\Factories\LeaveTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'default_balance',
    ];

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function leave_balances()
    {
        return $this->hasMany(LeaveBalance::class);
    }
}
