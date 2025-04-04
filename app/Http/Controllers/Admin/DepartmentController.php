<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.departments.departments', compact('departments'));
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required | unique:departments,name',
            'description' => 'required'
        ]);
        Department::create($validated);
        return redirect('/admin/departments/departments')->with('message', 'New department added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::findOrFail($id);
        $users = User::where('department_id', $id)->orderBy('created_at', 'desc')->paginate(12);
        return view('/admin/departments/show', compact('department', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit_department = Department::findOrFail($id);
        return view('/admin/departments/departments', compact('edit_department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $department = Department::findOrFail($id);
        $department->update($validatedData);

        return redirect()->route('all_department')
            ->with('message', 'Department updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::withTrashed()->findOrFail($id);
        $department->forceDelete();
        return redirect('/admin/departments/deleted_departments')->with('message', 'department deleted successfully');
    }

    public function soft_delete($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect('/admin/departments/departments')->with('message', 'department deleted successfully');
    }

    public function deleted_departments()
    {
        $departments = Department::onlyTrashed()->paginate(12);
        return view('/admin/departments/deleted_departments', compact('departments'));
    }

    public function restore($id)
    {
        $departmen = Department::onlyTrashed()->findOrFail($id);
        $departmen->restore();
        return redirect('/admin/departments/deleted_departments')->with('message', 'department restored successfully');
    }
}
