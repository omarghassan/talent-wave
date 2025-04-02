<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leave_type_id',
        'start_date',
        'end_date',
        'total_days',
        'reason',
        'status',
        'approved_by',
        'rejection_reason',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }

    public function approver()
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }

    /**
     * Boot method to automatically calculate total_days before saving.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($leave) {
            $leave->total_days = $leave->start_date->diffInDays($leave->end_date) + 1;
        });

        static::updating(function ($leave) {
            $leave->total_days = $leave->start_date->diffInDays($leave->end_date) + 1;
        });
    }
}
