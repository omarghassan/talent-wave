<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Department;
use App\Models\user;
use App\Models\DocumentType;
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

        $documentsType = DocumentType::all();
        return view('public.pages.documents.index', compact('documents', 'documentsType'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documentTypes = DocumentType::all(); // if you want to let the user choose a document type
        return view('public.pages.documents.create', compact('documentTypes'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:20480', // 20MB max
            'document_type_id' => 'required|exists:document_types,id',
        ]);

        // Upload file
        $filePath = $request->file('file')->store('documents', 'public');

        Document::create([
            'title' => $request->title,
            'file_path' => $filePath,
            'status' => 'pending',
            'document_type_id' => $request->document_type_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('docs.index')->with('success', 'Document uploaded successfully and is pending approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $document = Document::findOrFail($id);
        return view('public.pages.documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $document = Document::findOrFail($id);
        $documentTypes = DocumentType::all();
        return view('public.pages.documents.edit', compact('document', 'documentTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $document = Document::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'document_type_id' => 'required|exists:document_types,id',
            'expiry_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'file' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:20480', // 20MB max
        ]);

        $data = [
            'title' => $request->title,
            'document_type_id' => $request->document_type_id,
            'expiry_date' => $request->expiry_date,
            'notes' => $request->notes,
        ];

        // Only update file if a new one is uploaded
        if ($request->hasFile('file')) {
            // Delete old file
            if (Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            // Upload new file
            $filePath = $request->file('file')->store('documents', 'public');
            $data['file_path'] = $filePath;
        }

        $document->update($data);

        return redirect()->route('docs.index')->with('success', 'Document updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
