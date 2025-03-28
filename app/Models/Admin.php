<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['name', 'email', 'password', 'role','profile_picture'];

    protected $hidden = ['password'];

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
}
