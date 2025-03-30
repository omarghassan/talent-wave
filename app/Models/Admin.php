<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['name', 'email', 'password','profile_picture'];

    protected $hidden = ['password'];

    public function approvedLeaves()
    {
        return $this->hasMany(Leave::class, 'approved_by');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'created_by');
    }
}
