@extends('layouts.public')
@section('content')

<div class="container-fluid py-2">
  <div class="row">
    <div class="col-12">
      <form action="{{ route('attendance.check-in') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn bg-gradient-success" {{ isset($currentAttendance) && $currentAttendance->check_in ? 'disabled' : '' }}>
          <i class="fas fa-sign-in-alt me-2"></i>Check In
        </button>
      </form>
      <form action="{{ route('attendance.check-out') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn bg-gradient-danger" {{ !isset($currentAttendance) || !$currentAttendance->check_in || isset($currentAttendance) && $currentAttendance->check_out ? 'disabled' : '' }}>
          <i class="fas fa-sign-out-alt me-2"></i>Check Out
        </button>
      </form>
      
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h1 class="text-white text-capitalize ps-3">Attendances</h1>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          @if (session('success'))
            <div class="alert alert-success mx-3" role="alert">
              {{ session('success') }}
            </div>
          @endif

          @if (session('error'))
            <div class="alert alert-danger mx-3" role="alert">
              {{ session('error') }}
            </div>
          @endif
          
          @if(isset($currentAttendance))
          <div class="row mx-3 mb-4">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header pb-0">
                  <h6>Today's Attendance</h6>
                  <p class="text-sm">
                    <span id="current-time" class="font-weight-bold">{{ now()->format('H:i:s') }}</span>
                    <span class="text-secondary">{{ now()->format('l, d F Y') }}</span>
                  </p>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-6">
                      <p class="text-sm mb-0"><strong>Check In:</strong></p>
                      <p class="text-success font-weight-bold">
                        {{ $currentAttendance->check_in ? $currentAttendance->check_in->format('H:i:s') : 'Not checked in yet' }}
                      </p>
                    </div>
                    <div class="col-6">
                      <p class="text-sm mb-0"><strong>Check Out:</strong></p>
                      <p class="text-danger font-weight-bold">
                        {{ $currentAttendance->check_out ? $currentAttendance->check_out->format('H:i:s') : 'Not checked out yet' }}
                      </p>
                    </div>
                  </div>
                  @if($currentAttendance->check_in && $currentAttendance->check_out)
                  <div class="alert mt-2">
                    <strong>Total Hours:</strong> {{ $currentAttendance->total_hours }} hours
                  </div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card ">
                <div class="card-header pb-0">
                  <h6>Attendance Statistics</h6>
                  <p class="text-sm">Statistics from your recent attendance records</p>
                </div>
                <div class="card-body pt-0">
                  @php
                    $totalHours = 0;
                    $presentDays = 0;
                    $lateDays = 0;
                    
                    foreach($recentAttendances as $attendance) {
                        $totalHours += $attendance->total_hours ?? 0;
                        
                        if($attendance->status == 'present') {
                            $presentDays++;
                        }
                        
                        if($attendance->status == 'late') {
                            $lateDays++;
                        }
                    }
                  @endphp
                  <div class="row g-0">
                    <div class="col-4">
                      <div class="p-2 text-center">
                        <h3 class="mb-0">{{ $presentDays }}</h3>
                        <p class="text-xs text-secondary mb-0">Present Days</p>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="p-2 text-center">
                        <h3 class="mb-0">{{ $lateDays }}</h3>
                        <p class="text-xs text-secondary mb-0">Late Days</p>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="p-2 text-center">
                        <h3 class="mb-0">{{ number_format($totalHours, 1) }}</h3>
                        <p class="text-xs text-secondary mb-0">Total Hours</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
          
          <div class="table-responsive p-0">
            <table class="table text-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Attendance Date</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Check In</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Check Out</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Hours</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                </tr>
              </thead>
              <tbody>
                @if($recentAttendances->isEmpty())
                  <tr>
                    <td colspan="6" class="text-center">No attendance records found.</td>
                  </tr>
                @else
                  @foreach($recentAttendances as $attendance)
                  <tr>
                    <td>{{ $attendance->date->format('d/m/Y') }}</td>
                    <td>{{ $attendance->check_in ? $attendance->check_in->format('H:i:s') : '-' }}</td>
                    <td>{{ $attendance->check_out ? $attendance->check_out->format('H:i:s') : '-' }}</td>
                    <td>{{ $attendance->total_hours ?? '-' }}</td>
                    <td class="text-center">
                      @if($attendance->status == 'present')
                        <span class="badge bg-gradient-success">Present</span>
                      @elseif($attendance->status == 'late')
                        <span class="badge bg-gradient-warning">Late</span>
                      @elseif($attendance->status == 'absent')
                        <span class="badge bg-gradient-danger">Absent</span>
                      @else
                        <span class="badge bg-gradient-secondary">{{ ucfirst($attendance->status) }}</span>
                      @endif
                    </td>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    // Update current time every second
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        document.getElementById('current-time').textContent = timeString;
    }
    
    // Update time immediately and then every second
    updateTime();
    setInterval(updateTime, 1000);
</script>
@endpush