<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Report, Admin, Department, LeaveType, DocumentType, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('admin')->latest()->paginate(10);
        return view('admin.reports.index', compact('reports'));
    }

    public function create()
    {
        $types = \App\Models\Report::getTypes();
        $departments = Department::all();
        $leaveTypes = LeaveType::all();
        $documentTypes = DocumentType::all();

        return view('admin.reports.create', compact(
            'types',
            'departments',
            'leaveTypes',
            'documentTypes'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:' . implode(',', array_keys(Report::getTypes())),
            'description' => 'nullable|string',
            'parameters' => 'nullable|array'
        ]);

        $report = Report::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'description' => $validated['description'],
            'parameters' => $validated['parameters'] ?? [],
            'created_by' => Auth::guard('admin')->id()
        ]);

        // Generate report immediately (for demo)
        $this->generateReport($report);

        return redirect()->route('reports.index')
            ->with('message', 'Report generated successfully!');
    }

    public function show(Report $report)
    {
        return response()->file(Storage::path($report->file_path));
    }

    public function destroy(Report $report)
    {
        Storage::delete($report->file_path);
        $report->delete();

        return back()->with('message', 'Report deleted successfully');
    }

    protected function generateReport(Report $report)
    {
        $data = [
            'report' => $report,
            'admin' => $report->admin,
            'generated_at' => now()->format('Y-m-d H:i:s')
        ];

        switch ($report->type) {
            case 'leave_balance':
                $data['employees'] = User::with(['leaveBalances', 'department'])
                    ->when($report->parameters['department_id'] ?? false, function ($q, $deptId) {
                        $q->where('department_id', $deptId);
                    })
                    ->get();
                $view = 'admin.reports.templates.leave-balance';
                break;

            case 'attendance':
                // Add attendance report logic
                break;

                // Add other report types
        }

        $pdf = PDF::loadView($view, $data);
        $path = "reports/{$report->id}_" . now()->format('Ymd_His') . '.pdf';
        Storage::put($path, $pdf->output());
        $report->update(['file_path' => $path]);
    }
}
