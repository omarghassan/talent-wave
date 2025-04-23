<?php

namespace App\Observers;

use App\Models\Attendance;

class AttendanceObserver
{

    // In app/Observers/AttendanceObserver.php
    public function updated(Attendance $attendance)
    {
        // if ($attendance->isDirty(['check_in', 'check_out'])) {
        //     $attendance->calculateTotalHours();
        //     $attendance->calculateOvertime();
        // }
    }
    /**
     * Handle the Attendance "created" event.
     */
    public function created(Attendance $attendance): void
    {
        //
    }

    /**
     * Handle the Attendance "updated" event.
     */


    /**
     * Handle the Attendance "deleted" event.
     */
    public function deleted(Attendance $attendance): void
    {
        //
    }

    /**
     * Handle the Attendance "restored" event.
     */
    public function restored(Attendance $attendance): void
    {
        //
    }

    /**
     * Handle the Attendance "force deleted" event.
     */
    public function forceDeleted(Attendance $attendance): void
    {
        //
    }
}
