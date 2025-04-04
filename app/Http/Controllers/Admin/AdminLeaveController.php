<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Leave;
use App\Models\LeaveBalance;
use Illuminate\Support\Facades\Auth;

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
        // Update leave status
        $leave->status = 'approved';
        $leave->approved_by = Auth::id(); // Assuming admin is logged in
        $leave->save();

        // Update leave balance
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

        return redirect()->back()->with('success', 'Leave request approved');
    }

    public function reject(Request $request, Leave $leave)
    {
        $request->validate([
            'rejection_reason' => 'required|string'
        ]);

        $leave->status = 'rejected';
        $leave->approved_by = Auth::id(); // Assuming admin is logged in
        $leave->rejection_reason = $request->rejection_reason;
        $leave->save();

        return redirect()->back()->with('success', 'Leave request rejected');
    }

    public function downloadPdf(Request $request)
    {
        // Get leaves with proper eager loading
        $leaves = Leave::with(['user', 'leaveType'])
            ->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->get();

        // Create a PDF specific view (not using the same view as your web page)
        $pdf = PDF::loadView('admin.leaves.leavepdf', compact('leaves'))
            ->setPaper('A4', 'landscape'); // Landscape orientation

        return $pdf->download('leaves-report-' . now()->format('Y-m-d') . '.pdf');
    }
}
