<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $fillable = ['name', 'email', 'password', 'profile_picture'];

    protected $hidden = ['password'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function approvedLeaves()
    {
        return $this->hasMany(Leave::class, 'approved_by');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'created_by');
    }

    // Add relationship to approved tickets
    public function approvedTickets()
    {
        return $this->hasMany(Ticket::class, 'approved_by');
    }

    // Add relationship to rejected tickets
    public function rejectedTickets()
    {
        return $this->hasMany(Ticket::class, 'rejected_by');
    }
}
