<!DOCTYPE html>
<html>
<head>
    <title>Employee Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 20px; }
        .logo { height: 60px; margin-bottom: 10px; }
        h1 { color: #2c3e50; margin: 0; font-size: 24px; }
        .report-info { margin-top: 10px; font-size: 14px; color: #7f8c8d; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }
        th { background-color: #34495e; color: white; text-align: left; padding: 10px; }
        td { padding: 10px; border-bottom: 1px solid #eee; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { margin-top: 30px; text-align: center; font-size: 11px; color: #95a5a6; border-top: 1px solid #eee; padding-top: 10px; }
        .signature { margin-top: 50px; }
        .profile-pic { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Employee Directory Report</h1>
        <div class="report-info">
            Generated on: {{ now()->format('F j, Y \a\t h:i A') }}<br>
            Total Employees: {{ count($users) }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Profile</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Job Title</th>
                <th>Department</th>
                <th>Salary</th>
                <th>Hire Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>
                    @if($user->profile_picture)
                    <img src="{{ storage_path('app/public/' . $user->profile_picture) }}" class="profile-pic">
                    @else
                    <div style="width:40px;height:40px;background:#eee;border-radius:50%;"></div>
                    @endif
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone ?? 'N/A' }}</td>
                <td>{{ $user->job_title ?? 'N/A' }}</td>
                <td>{{ $user->department->name ?? 'N/A' }}</td>
                <td>{{ $user->salary ? '$' . number_format($user->salary, 2) : 'N/A' }}</td>
                <td>{{ $user->hire_date ? \Carbon\Carbon::parse($user->hire_date)->format('M d, Y') : 'N/A' }}</td>
                <td>
                    @if($user->deleted_at)
                    <span style="color:#e74c3c;">Inactive</span>
                    @else
                    <span style="color:#2ecc71;">Active</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Confidential - For internal use only<br>
        {{ config('app.name') }} &copy; {{ date('Y') }}
    </div>
</body>
</html>