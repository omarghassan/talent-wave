<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hrs = Admin::where('role','hr')->orderBy('created_at','desc')->paginate(10);
        return view('admin.hrs.hr', compact('hrs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hrs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required | unique:admins,email',
            'password' => 'required | confirmed | min:8 | max:30',
            'profile_picture' => 'nullable'
        ]);
        Admin::create($validated);
        return redirect('/admin/hrs/hr')->with('message', 'New HR added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hr = Admin::findOrFail($id);
        return view('admin.hrs.show',compact('hr'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hr = Admin::findOrFail($id);
        return view('admin.hrs.edit', compact('hr'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $id . ',id',
            'password' => 'required | confirmed | min:8 | max: 33',
            'profile_picture' => 'required'
        ]);
        Admin::findOrFail($id)->update($validated);
        return redirect('/admin/hrs/hr')->with('message', 'New HR edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hr = Admin::withTrashed()->findOrFail($id);
        $hr->forceDelete();
        return redirect('/admin/hrs/deletedhr')->with('message', 'HR deleted successfully');
    }

    public function logout (Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return view('admin/login');
    }

    public function show_login_form (){
        return view('admin.login');
    }

    public function login (Request $request){
        $validated = $request->validate([
            "email" => "required|email",
            "password" => "required|min:6",
        ]);
        
        if(Auth::guard('admin')->attempt($validated)){
            $request->session()->regenerate();
            return Redirect("/admin/adminusers/users");
        }else{
            return redirect()->back()->withInput();
        }
    }

    public function soft_delete($id){
        $hr = Admin::findOrFail($id);
        $hr->delete();
        return redirect('/admin/hrs/hr')->with('message', 'HR Deleted successfully');
    }

    public function show_deletedHR(){
        $hrs = Admin::onlyTrashed()->paginate(12);
        return view('admin.hrs.deletedhr', compact('hrs'));
    }

    public function restore($id){
        $hr = Admin::withTrashed()->findOrFail($id);
        $hr->restore();
        return redirect('/admin/hrs/hr')->with('message', 'HR restored successfully');
    }
}