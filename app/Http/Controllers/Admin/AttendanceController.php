<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $today = today();
        $stats = [
            'totalEmployees' => User::whereNull('deleted_at')->count(),
            'presentToday' => Attendance::whereDate('date', today())
                ->where('status', 'present')
                ->whereHas('user', fn($q) => $q->whereNull('deleted_at'))
                ->count(),
            'absentToday' => Attendance::whereDate('date', today())
                ->where('status', 'absent')
                ->whereHas('user', fn($q) => $q->whereNull('deleted_at'))
                ->count(),
            'lateToday' => Attendance::whereDate('date', today())
                ->where('status', 'late')
                ->whereHas('user', fn($q) => $q->whereNull('deleted_at'))
                ->count(),
            'onLeaveToday' => Attendance::whereDate('date', today())
                ->where('status', 'on_leave')
                ->whereHas('user', fn($q) => $q->whereNull('deleted_at'))
                ->count(),
        ];

        // Get lists of employees for each status
        $presentEmployees = Attendance::with('user')
            ->whereDate('date', today())
            ->where('status', 'present')
            ->whereHas('user', fn($q) => $q->whereNull('deleted_at'))
            ->get();

        $absentEmployees = User::whereNull('deleted_at')
            ->whereDoesntHave('attendances', function ($q) {
                $q->whereDate('date', today());
            })
            ->get();

        $lateEmployees = Attendance::with('user')
            ->whereDate('date', today())
            ->where('status', 'late')
            ->whereHas('user', fn($q) => $q->whereNull('deleted_at'))
            ->get();

        $onLeaveEmployees = User::whereNull('deleted_at')
            ->whereHas('leaves', function ($query) use ($today) {
                $query->where('status', 'Approved')
                    ->where('start_date', '<=', $today)
                    ->where('end_date', '>=', $today);
            })
            ->with(['leaves' => function ($query) use ($today) {
                $query->where('status', 'Approved')
                    ->where('start_date', '<=', $today)
                    ->where('end_date', '>=', $today);
            }])
            ->get();

        $query = Attendance::with(['user' => function ($query) {
            $query->whereNull('deleted_at');
        }])
            ->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');

        // Apply filters
        if ($request->filled('start_date')) {
            $query->where('date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('date', '<=', $request->end_date);
        }

        if ($request->filled('user_search')) {
            $searchTerm = $request->user_search;
            $query->whereHas('user', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('id', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $attendances = $query->paginate(25);

        return view('admin.attendance.index', [
            'attendances' => $attendances,
            'users' => User::all(),
            'presentCount' => $stats['presentToday'],
            'absentCount' => $stats['absentToday'],
            'lateCount' => $stats['lateToday'],
            'onLeaveCount' => $stats['onLeaveToday'],
            'stats' => $stats,
            'presentEmployees' => $presentEmployees,
            'absentEmployees' => $absentEmployees,
            'lateEmployees' => $lateEmployees,
            'onLeaveEmployees' => $onLeaveEmployees
        ]);
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
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function downloadAttendancePdf(Request $request)
    {

        $query = Attendance::with(['user' => function ($query) {

            $query->whereNull('deleted_at');
        }])
            ->whereHas('user', function ($query) {

                $query->whereNull('deleted_at');
            })
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');



        $attendances = $query->get();

        $pdf = PDF::loadView('admin.attendance.pdf', [
            'attendances' => $attendances,
            'filters' => [
                'date_range' => $request->start_date && $request->end_date
                    ? $request->start_date . ' to ' . $request->end_date
                    : 'All Dates',
                'employee' => $request->user_search ?? 'All Employees',
                'status' => $request->status ? ucfirst(str_replace('_', ' ', $request->status)) : 'All Statuses'
            ]
        ])->setPaper('a4', 'landscape');

        return $pdf->download('attendance-report_' . now()->format('Y-m-d') . '.pdf');
    }
}
