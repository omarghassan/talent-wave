<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leaveTypes = LeaveType::orderBy('created_at', 'desc')->get();
        return view('admin.leaves.leave-type', compact('leaveTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'default_balance' => 'required|numeric|min:0'
        ]);

        LeaveType::create($request->all());
        return redirect()->back()->with('success', 'Leave type created successfully');
    }

    public function update(Request $request, LeaveType $leaveType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'default_balance' => 'required|numeric|min:0'
        ]);

        $leaveType->update($request->all());
        return redirect()->back()->with('success', 'Leave type updated successfully');
    }
}
