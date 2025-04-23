<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $currentAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();

        $recentAttendances = Attendance::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->take(10)
            ->get();

        return view("public.pages.attendances.index", compact("recentAttendances", "currentAttendance"));
    }

    /**
     * Process check-in.
     */
    public function checkIn(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now();
        $today = Carbon::today();

        // Check if already checked in today
        $existingAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();

        // تحديد الساعة 9:00 صباحًا
        $lateTime = Carbon::createFromTime(9, 0, 0); // 9:00 AM

        // تحديد الحالة: إذا دخل بعد 9، يعتبر "late"
        $status = $now->greaterThan($lateTime) ? 'late' : 'present';

        if ($existingAttendance) {
            if ($existingAttendance->check_in) {
                return redirect()->route('attendances.index')
                    ->with('error', 'You have already checked in today.');
            }

            // Update existing record with check-in time
            $existingAttendance->update([
                'check_in' => $now,
                'status' => $status
            ]);

            return redirect()->route('attendances.index')
                ->with('success', 'Check-in successful at ' . $now->format('H:i:s'));
        }

        // Create new attendance record
        Attendance::create([
            'user_id' => $user->id,
            'date' => $today,
            'check_in' => $now,
            'status' => $status
        ]);

        return redirect()->route('attendances.index')
            ->with('success', 'Check-in successful at ' . $now->format('H:i:s'));
    }

    /**
     * Process check-out.
     */
    public function checkOut(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now();
        $today = Carbon::today();

        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();

        if (!$attendance) {
            return redirect()->route('attendances.index')
                ->with('error', 'You need to check in first before checking out.');
        }

        if (!$attendance->check_in) {
            return redirect()->route('attendances.index')
                ->with('error', 'You need to check in first before checking out.');
        }

        if ($attendance->check_out) {
            return redirect()->route('attendances.index')
                ->with('error', 'You have already checked out today.');
        }

        // Calculate total hours
        $checkInTime = Carbon::parse($attendance->check_in);
        $totalHours = $checkInTime->diffInSeconds($now) / 3600; // Convert seconds to hours
        $over_time = 0;
        $shortage_hours = 0;
        if ($totalHours > 8) {
            $over_time = $totalHours - 8;
        } else if ($totalHours < 8) {
            $shortage_hours = 8 - $totalHours;
        }

        $attendance->update([
            'check_out' => $now,
            'total_hours' => round($totalHours, 2,),
            'overtime_hours' => $over_time,
            'shortage_hours' => $shortage_hours
        ]);

        return redirect()->route('attendances.index')
            ->with('success', 'Check-out successful at ' . $now->format('H:i:s') . '. Total hours worked: ' . round($totalHours, 2));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
