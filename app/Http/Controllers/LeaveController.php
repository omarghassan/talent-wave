<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\LeaveType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();
        return view("public.pages.leaves.index", compact("leaves"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leaveTypes = LeaveType::all();
        return view("public.pages.leaves.create", compact('leaveTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string|max:500',
        ]);

        // Add the authenticated user's ID to the validated data
        $validated['user_id'] = Auth::id();
        // Set default status
        $validated['status'] = 'Pending';

        $leave = Leave::create($validated);

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Leave $leave)
    // {
    //     // Ensure users can only view their own leave requests
    //     // if ($leave->user_id !== Auth::id()) {
    //     //     abort(403, 'Unauthorized action.');
    //     // }
    //     $leaveType = LeaveType::all();
    //     return view("public.pages.leaves.show", compact('leave', 'leaveType'));
    // }

    public function show($id)
    {
        $leave = Leave::with('leavetype')->findOrFail($id);
        return view('public.pages.leaves.show', compact('leave'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Leave $leave)
    // {
    //     // Ensure users can only edit their own leave requests
    //     // if ($leave->user_id !== Auth::id()) {
    //     //     abort(403, 'Unauthorized action.');
    //     // }

    //     // Only allow editing if status is pending
    //     if ($leave->status !== 'Pending') {
    //         return redirect()->route('leaves.index')
    //             ->with('error', 'You cannot edit a leave request that has already been processed.');
    //     }

    //     $leaveTypes = LeaveType::all();
    //     return view("public.pages.leaves.edit", compact('leave', 'leaveTypes'));
    // }

    public function edit($id)
    {
        $leaveTypes = LeaveType::all();
        $leave = Leave::find($id);
        if (!$leave) {
            return redirect()->route('leaves.index')->with('error', 'Leave request not found.');
        }


        return view("public.pages.leaves.edit", compact('leave', 'leaveTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Leave $leave)
    // {
    //     // Ensure users can only update their own leave requests
    //     // if ($leave->user_id !== Auth::id()) {
    //     //     abort(403, 'Unauthorized action.');
    //     // }

    //     // Only allow updating if status is pending
    //     if ($leave->status !== 'Pending') {
    //         return redirect()->route('leaves.index')
    //             ->with('error', 'You cannot update a leave request that has already been processed.');
    //     }

    //     $validated = $request->validate([
    //         'leave_type_id' => 'required|exists:leave_types,id',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after_or_equal:start_date',
    //         'reason' => 'nullable|string|max:500',
    //     ]);

    //     $leave->update($validated);

    //     return redirect()->route('leaves.index')
    //         ->with('success', 'Leave request updated successfully.');
    // }

    public function update(Request $request, Leave $leave)
    {
        if ($leave->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($leave->status !== 'Pending') {
            return redirect()->route('leaves.index')
                ->with('error', 'You cannot edit a leave request that has already been processed.');
        }

        $validatedData = $request->validate([
            'leave_type' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string',
        ]);

        $leave->update([
            'leave_type_id' => $validatedData['leave_type'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'reason' => $validatedData['reason'],
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        // Ensure users can only delete their own leave requests
        // if ($leave->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized action.');
        // }

        // Only allow deletion if status is pending
        if ($leave->status !== 'Pending') {
            return redirect()->route('leaves.index')
                ->with('error', 'You cannot cancel a leave request that has already been processed.');
        }

        $leave->delete();

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request cancelled successfully.');
    }
}
