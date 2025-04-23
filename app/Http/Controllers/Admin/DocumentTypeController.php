<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\DocumentType;


class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $document_types = DocumentType::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.document-type.index', compact('document_types'));
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
        DocumentType::create($validated);
        return redirect('admin.document-type.index')->with('message', 'New department added successfully');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit_department = DocumentType::findOrFail($id);
        return view('admin.document-type.index', compact('edit_department'));
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

        $department = DocumentType::findOrFail($id);
        $department->update($validatedData);

        return redirect()->route('document_type.index')
            ->with('message', 'Document type updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = DocumentType::withTrashed()->findOrFail($id);
        $department->forceDelete();
        return redirect('admin.document-type.index')->with('message', 'Document type deleted successfully');
    }

    public function soft_delete($id)
    {
        $department = DocumentType::findOrFail($id);
        $department->delete();
        return redirect('admin.document-type.index')->with('message', 'Document type deleted successfully');
    }

    public function deleted_departments()
    {
        $departments = DocumentType::onlyTrashed()->paginate(12);
        return view('admin.document-type.index', compact('departments'));
    }

    public function restore($id)
    {
        $departmen = DocumentType::onlyTrashed()->findOrFail($id);
        $departmen->restore();
        return redirect('admin.document-type.index')->with('message', 'Document type restored successfully');
    }
}
