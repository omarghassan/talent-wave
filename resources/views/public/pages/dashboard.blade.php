@extends('layouts.public')
@section('content')

<div class="container-fluid py-2">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h1 class="text-white text-capitalize ps-3">Dashboard</h1>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="card mb-3">
                      <div class="card-body">
                        <h5 class="card-title">Employee Information</h5>
                        <p><strong>Employee ID:</strong> {{ Auth::user()->id }}</p>
                        <p><strong>Department:</strong> {{ Auth::user()->department->name ?? 'Not Assigned' }}</p>
                        <p><strong>Job Title:</strong> {{ Auth::user()->job_title }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card mb-3">
                      <div class="card-body">
                        <h5 class="card-title">Quick Links</h5>
                        <div class="d-grid ">
                          <a href="{{ route('leaves.create') }}" class="btn btn-dark">Apply for Leave</a>
                          <a href="{{ route('attendances.index') }}" class="btn btn-dark">View Attendance</a>
                        </div>
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
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Leave Requests</h5>
                <a href="{{ route('leaves.index') }}" class="btn btn-sm btn-dark">View All</a>
              </div>
              <div class="card-body">
                @php
                $recentLeaves = Auth::user()->leaves()->latest()->take(5)->get();
                @endphp
                @if ($recentLeaves->isEmpty())
                <div class="alert " role="alert">You have no recent leave requests.</div>
                @else
                <div class="table-responsive">
                  <table class="table text-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Leave Type</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Period</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Days</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($recentLeaves as $leave)
                      <tr>
                        <td>{{ $leave->leavetype->name ?? 'N/A' }}</td>
                        <td>{{ $leave->start_date->format('d/m/Y') }} - {{ $leave->end_date->format('d/m/Y') }}</td>
                        <td>{{ $leave->total_days }}</td>
                        <td>
                          @if($leave->status == 'Pending')
                          <span class="badge bg-warning">Pending</span>
                          @elseif($leave->status == 'Approved')
                          <span class="badge bg-success">Approved</span>
                          @elseif($leave->status == 'Rejected')
                          <span class="badge bg-danger">Rejected</span>
                          @else
                          <span class="badge bg-secondary">{{ $leave->status }}</span>
                          @endif
                        </td>
                        <td>
                          <div class="btn-group" role="group">
                            <a href="{{ route('leaves.show', $leave->id) }}" class="btn btn-success btn-sm">View</a>
                            @if($leave->status == 'Pending')
                            <a href="{{ route('leaves.edit', $leave->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endif
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection