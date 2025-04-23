<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'approved_by',
        'rejected_by',
        'approved_at',
        'rejected_at',
        'priority',
        'category'
    ];
    
    protected $casts = [
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];
    
    // Define the statuses as constants
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    
    // Define priorities
    const PRIORITY_LOW = 'low';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_HIGH = 'high';
    
    // User who created this ticket
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Admin who approved this ticket
    public function approvedBy()
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }
    
    // Admin who rejected this ticket
    public function rejectedBy()
    {
        return $this->belongsTo(Admin::class, 'rejected_by');
    }
    
    // Scope to get pending tickets
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }
    
    // Scope to get approved tickets
    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }
    
    // Scope to get rejected tickets
    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }
}