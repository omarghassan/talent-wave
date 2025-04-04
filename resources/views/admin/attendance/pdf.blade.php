<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 16px; font-weight: bold; }
        .subtitle { font-size: 14px; margin-bottom: 5px; }
        .filters { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f2f2f2; text-align: left; }
        th, td { border: 1px solid #ddd; padding: 5px; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Attendance Report</div>
        <div class="subtitle">Generated on: {{ now()->format('M d, Y H:i') }}</div>
    </div>
    
    <div class="filters">
        <strong>Filters Applied:</strong><br>
        Date Range: {{ $filters['date_range'] }}<br>
        Employee: {{ $filters['employee'] }}<br>
        Status: {{ $filters['status'] }}
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Total Hours</th>
                <th>Status</th>
                <th>Overtime</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $index => $attendance)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $attendance->user->name ?? 'N/A' }}</td>
                <td>{{ $attendance->date->format('Y-m-d') }}</td>
                <td>{{ $attendance->check_in ? $attendance->check_in->format('H:i') : '-' }}</td>
                <td>{{ $attendance->check_out ? $attendance->check_out->format('H:i') : '-' }}</td>
                <td>{{ $attendance->total_hours ?? '-' }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $attendance->status)) }}</td>
                <td>{{ $attendance->overtime_hours ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>