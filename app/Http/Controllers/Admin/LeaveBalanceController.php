<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\LeaveType;
use App\Models\LeaveBalance;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LeaveBalanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::all();
        $leaveTypes = LeaveType::all();
        $year = date('Y');
        //     $leaveBalances = LeaveBalance::with('user', 'leave_type')
        // ->select(
        //     'id', 
        //     'user_id', 
        //     'leave_type_id', 
        //     DB::raw('SUM(allocated) as total_allocated'), 
        //     DB::raw('SUM(used) as total_used'), 
        //     DB::raw('SUM(remaining) as total_remaining')
        // )
        // ->whereHas('user', function ($query) {
        //     $query->whereNull('deleted_at');
        // })
        // ->groupBy('id', 'user_id', 'leave_type_id')
        // ->paginate(12);
        $leaveBalances = LeaveBalance::with(['user', 'leave_type'])
            ->select(
                'id',
                'user_id',
                'leave_type_id',
                DB::raw('SUM(allocated) as total_allocated'),
                DB::raw('SUM(used) as total_used'),
                DB::raw('SUM(remaining) as total_remaining')
            )
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('id', 'like', "%{$search}%");
                })
                    ->orWhere('user_id', 'like', "%{$search}%");
            })
            ->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->groupBy('id', 'user_id', 'leave_type_id')
            ->paginate(12);

        return view('admin.leaves.leave-balance', compact('users', 'leaveTypes', 'leaveBalances', 'year'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'year' => 'required|integer',
            'allocated' => 'required|numeric|min:0'
        ]);

        $leaveBalance = LeaveBalance::firstOrNew([
            'user_id' => $request->user_id,
            'leave_type_id' => $request->leave_type_id,
            'year' => $request->year
        ]);

        $used = $leaveBalance->used ?? 0;
        $leaveBalance->allocated = $request->allocated;
        $leaveBalance->remaining = $request->allocated - $used;
        $leaveBalance->save();

        return redirect()->back()->with('success', 'Leave balance updated successfully');
    }
    public function show_update($id)
    {
        $users = User::all();
        $leaveTypes = LeaveType::all();
        $year = Carbon::now()->year;
        $balance = LeaveBalance::findOrFail($id);
        return view('admin.leaves.update', compact('balance', 'year', 'users', 'leaveTypes'));
    }



    // public function downloadPdf()
    // {

    //     $leaveBalances = LeaveBalance::with('user', 'leave_type')
    //     ->select(
    //         'id', 
    //         'user_id', 
    //         'leave_type_id', 
    //         DB::raw('SUM(allocated) as total_allocated'), 
    //         DB::raw('SUM(used) as total_used'), 
    //         DB::raw('SUM(remaining) as total_remaining')
    //     )
    //     ->whereHas('user', function ($query) {
    //         $query->whereNull('deleted_at');
    //     })
    //     ->groupBy('id', 'user_id', 'leave_type_id')
    //     ->get();


    //     $pdf = Pdf::loadView('admin.leaves.leave_balancepdf', [
    //         'leaveBalances' => $leaveBalances,
    //         'title' => 'Employee Leave Balances Report',
    //         'date' => now()->format('F d, Y')
    //     ]);

    //     return $pdf->download('leave_balances_'.now()->format('Ymd').'.pdf');
    // }
    public function downloadPdf()
    {
        $leaveBalances = LeaveBalance::with(['user', 'leave_type'])
            ->select(
                'id',
                'user_id',
                'leave_type_id',
                DB::raw('SUM(allocated) as total_allocated'),
                DB::raw('SUM(used) as total_used'),
                DB::raw('SUM(remaining) as total_remaining')
            )
            ->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->whereHas('leave_type') // Ensure only records with leave types are included
            ->groupBy('id', 'user_id', 'leave_type_id')
            ->get();

        $pdf = Pdf::loadView('admin.leaves.leave_balancepdf', [
            'leaveBalances' => $leaveBalances,
            'title' => 'Employee Leave Balances Report',
            'date' => now()->format('F d, Y')
        ]);

        return $pdf->download('leave_balances_' . now()->format('Ymd') . '.pdf');
    }
}
