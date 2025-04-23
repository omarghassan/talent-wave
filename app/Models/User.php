<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'employee_id',
        'department_id',
        'job_title',
        'hire_date',
        'phone',
        'address',
        'profile_picture',
        'salary',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function leaveBalances()
    {
        return $this->hasMany(LeaveBalance::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // Add relationship to tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    protected static function booted()
    {
        parent::boot();

        static::created(function ($user) {



            $leaveTypes = LeaveType::all();
            foreach ($leaveTypes as $leaveType) {
                LeaveBalance::create([
                    'user_id' => $user->id,
                    'leave_type_id' => $leaveType->id,
                    'year' => Carbon::now()->year,
                    'allocated' => $leaveType->default_balance,
                    'used' => 0,
                    'remaining' => $leaveType->default_balance,
                ]);
            }
        });

        static::deleting(function ($user) {
            // When soft deleting a user (just leave attendances as-is)
            if (!$user->isForceDeleting()) {
                return;
            }

            // When force deleting a user, delete all attendances
            $user->attendances()->delete();
        });

        static::deleting(function ($user) {
            // When soft deleting a user (just leave attendances as-is)
            if (!$user->isForceDeleting()) {
                return;
            }

            // When force deleting a user, delete all attendances
            $user->leave_balance()->delete();
        });

        static::deleting(function ($user) {
            // When soft deleting a user (just leave attendances as-is)
            if (!$user->isForceDeleting()) {
                return;
            }

            // When force deleting a user, delete all attendances
            $user->leaves()->delete();
        });

        static::restoring(function ($user) {
            // No need to restore attendances since they weren't deleted
            // during soft deletion
        });
    }
}
