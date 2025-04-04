<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'type',
        'parameters',
        'created_by',
        'file_path',
    ];

    protected $casts = [
        'parameters' => 'array',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    // Helper to get available report types
    public static function getTypes(): array
    {
        return [
            'leave_balance' => 'Leave Balance Report',
            'attendance' => 'Attendance Report',
            'payroll' => 'Payroll Summary',
            'department' => 'Department Summary',
            'document' => 'Document Status Report'
        ];
    }
}
