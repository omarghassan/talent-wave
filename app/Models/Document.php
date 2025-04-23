<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'user_id',
        'document_type_id',
        'title',
        'file_path',
        'status',
        'expiry_date',
        'notes',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
    }
}
