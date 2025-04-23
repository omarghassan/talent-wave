<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\user;
use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter');

        $documents = Document::when($filter, function ($query) use ($filter) {
            return $query->where('status', $filter);
        })->whereHas('user', function ($query) {

            $query->whereNull('deleted_at');
        })->get();

        return view('admin.document.index', compact('documents'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function download($id)
    {
        $document = Document::findOrFail($id);

        // Check if the file exists in the storage path
        if (Storage::disk('public')->exists($document->file_path)) {
            // Get the full path
            $path = Storage::disk('public')->path($document->file_path);

            // Get original filename or use the title with proper extension
            $filename = $document->title . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION);

            // Return the file as a download
            return response()->download($path, $filename);
        }

        // Check alternative path as a fallback
        $alternativePath = public_path('storage/' . $document->file_path);
        if (file_exists($alternativePath)) {
            $filename = $document->title . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION);
            return response()->download($alternativePath, $filename);
        }

        return back()->with('error', 'File not found.');
    }

    public function view($id)
    {
        $document = Document::findOrFail($id);

        // Check if file exists in storage
        if (Storage::disk('public')->exists($document->file_path)) {
            // Get the full path to the file
            $fullPath = Storage::disk('public')->path($document->file_path);

            // Get the MIME type of the file
            $mimeType = Storage::disk('public')->mimeType($document->file_path);

            // Create a response with appropriate headers
            return response()->file($fullPath, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline; filename="' . basename($fullPath) . '"'
            ]);
        }

        return back()->with('error', 'File not found.');
    }

    public function reject($id)
    {
        $document = Document::findOrFail($id);
        $document->update(['status' => 'rejected']);
        return redirect()->back();
    }

    public function approve($id)
    {
        $document = Document::findOrFail($id);
        $document->update(['status' => 'approved']);
        return redirect()->back();
    }
}
