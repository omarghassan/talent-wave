<!DOCTYPE html>
<html>
<head>
    <title>Leave Requests Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 16px; font-weight: bold; }
        .subtitle { font-size: 14px; margin-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f2f2f2; text-align: left; padding: 5px; }
        th, td { border: 1px solid #ddd; padding: 5px; font-size: 10px; }
        .badge {
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 9px;
            color: white;
            display: inline-block;
        }
        .bg-success { background-color: #28a745; }
        .bg-warning { background-color: #ffc107; color: #212529; }
        .bg-danger { background-color: #dc3545; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Leave Requests Report</div>
        <div class="subtitle">Generated on: {{ now()->format('M d, Y H:i') }}</div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Employee</th>
                <th>Leave Type</th>
                <th>Duration</th>
                <th>Days</th>
                <th>Reason</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaves as $leave)
            <tr>
                <td>
                    {{ $leave->user ? $leave->user->name : 'N/A' }}
                </td>
                <td>
                    {{ $leave->leaveType ? $leave->leaveType->name : 'N/A' }}
                </td>
                <td>
                    {{ $leave->start_date->format('M d') }} - {{ $leave->end_date->format('M d, Y') }}
                </td>
                <td>
                    {{ $leave->total_days }}
                </td>
                <td>
                    {{ $leave->reason ?? 'N/A' }}
                </td>
                <td>
                    @if ($leave->status == 'Approved')
                        <span class="badge bg-success">Approved</span>
                    @elseif($leave->status == 'Pending')
                        <span class="badge bg-warning">Pending</span>
                    @else
                        <span class="badge bg-danger">Rejected</span>
                        @if ($leave->rejection_reason)
                            <small style="display: block; margin-top: 3px;">{{ $leave->rejection_reason }}</small>
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>