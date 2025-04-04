<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #344767;
            color: white;
            font-weight: bold;
        }

        .employee-cell {
            display: flex;
            align-items: center;
        }

        .employee-info {
            margin-left: 10px;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Generated on: {{ $date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Employee</th>
                <th>Leave Type</th>
                <th>Allocated</th>
                <th>Used</th>
                <th>Remaining</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaveBalances as $leave)
            <tr>
                <td>
                    <div class="employee-cell">
                        <div class="employee-info">
                            {{ $leave->user->name ?? 'N/A' }}
                        </div>
                    </div>
                </td>
                <td>{{ $leave->leave_type->name ?? 'N/A' }}</td>
                <td>{{ $leave->total_allocated }}</td>
                <td>{{ $leave->total_used }}</td>
                <td>{{ $leave->total_remaining }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>© {{ date('Y') }} Your Company Name. All rights reserved.</p>
    </div>
</body>

</html>