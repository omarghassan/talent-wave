<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\Department;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $department_id = $request->input("department_id");
        $departments = Department::all();
        $search = $request->input('search');
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%");
        })
            ->when($department_id, function ($query, $department_id) {
                return $query->where('department_id', $department_id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        return view("admin.adminusers.users", compact("departments", "users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('admin.adminusers.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required | confirmed | min:8 | max: 33',
            'phone' => 'required | unique:users,phone',
            'salary' => 'required',
            'department_id' => 'required',
            'job_title' => 'required',
            'hire_date' => 'required',
            'profile_picture' => 'nullable',
            'address' => 'nullable'
        ]);
        User::create($validated);
        return redirect('/admin/adminusers/users')->with('message', 'New user added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view("/admin/adminusers/show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $departments = Department::all();
        return view('/admin/adminusers/edit', compact('user', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // First validate the old password
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The old password is incorrect']);
        }

        // Validate the rest of the form data
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'salary' => 'required',
            'department_id' => 'required',
            'job_title' => 'required',
            'hire_date' => 'required',
            'profile_picture' => 'nullable',
            'address' => 'nullable'
        ]);

        // Check if a new password is being set
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'confirmed|min:8|max:33',
            ]);
            $validated['password'] = Hash::make($request->password);
        } else {
            // Keep the old password
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect('/admin/adminusers/users')->with('message', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/admin/adminusers/users')->with('message', ' user deleted successfully');
    }

    public function show_deleted_users()
    {
        $users = User::onlyTrashed()->paginate(10);
        return view("admin.adminusers.deletedusers", compact("users"));
    }

    public function delete_user($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect('/admin/adminusers/deletedusers')->with('message', ' user deleted successfully');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect('/admin/adminusers/users')->with('message', ' user restored successfully');
    }

    public function downloadPDF()
    {
        $users = User::with('department')->get();

        $pdf = PDF::loadView('/admin/adminusers/pdfemployees', compact('users'))
            ->setPaper('A4', 'landscape'); // Landscape orientation

        return $pdf->download('employees-report_' . now()->format('Y-m-d') . '.pdf');
    }
}
