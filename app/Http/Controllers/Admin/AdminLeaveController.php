<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Leave;
use App\Models\LeaveBalance;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use DateTime;
use DateInterval;
use DatePeriod;

class AdminLeaveController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');
        $department_id = $request->input("department_id");
        $leaves = Leave::when($search, function ($query, $search) {
            return $query->where('user_id', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%");
        })
            ->when($department_id, function ($query, $department_id) {
                return $query->where('status', $department_id);
            })
            ->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);


        return view('admin.leaves.index', compact("leaves"));
    }


    public function approve(Leave $leave)
    {

        $leave->status = 'approved';
        $leave->approved_by = Auth::id();
        $leave->save();


        $year = date('Y', strtotime($leave->start_date));
        $leaveBalance = LeaveBalance::where('user_id', $leave->user_id)
            ->where('leave_type_id', $leave->leave_type_id)
            ->where('year', $year)
            ->first();

        if ($leaveBalance) {
            $leaveBalance->used += $leave->total_days;
            $leaveBalance->remaining = $leaveBalance->allocated - $leaveBalance->used;
            $leaveBalance->save();
        }


        $startDate = new \DateTime($leave->start_date);
        $endDate = new \DateTime($leave->end_date);
        $interval = new \DateInterval('P1D');
        $dateRange = new \DatePeriod($startDate, $interval, $endDate->modify('+1 day'));

        foreach ($dateRange as $date) {
            $dateStr = $date->format('Y-m-d');


            $existingRecord = Attendance::where('user_id', $leave->user_id)
                ->whereDate('date', $dateStr)
                ->first();

            if (!$existingRecord) {

                Attendance::create([
                    'user_id' => $leave->user_id,
                    'date' => $dateStr,
                    'status' => 'on_leave',
                    'time_in' => null,
                    'time_out' => null,
                    'remarks' => 'On approved leave'
                ]);
            } else {

                $existingRecord->update([
                    'status' => 'on_leave',
                    'remarks' => 'On approved leave'
                ]);
            }
        }

        return redirect()->back()->with('success', 'Leave request approved');
    }

    public function reject(Request $request, Leave $leave)
    {
        $request->validate([
            'rejection_reason' => 'required|string'
        ]);

        $leave->status = 'rejected';
        $leave->approved_by = Auth::id();
        $leave->rejection_reason = $request->rejection_reason;
        $leave->save();

        return redirect()->back()->with('success', 'Leave request rejected');
    }

    public function downloadPdf(Request $request)
    {

        $leaves = Leave::with(['user', 'leaveType'])
            ->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->get();


        $pdf = PDF::loadView('admin.leaves.leavepdf', compact('leaves'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('leaves-report-' . now()->format('Y-m-d') . '.pdf');
    }
}
