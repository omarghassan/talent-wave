@extends('layouts.public')
@section('content')

<div class="container-fluid py-2">
  <div class="row">
    <div class="col-12">
      <div class="card my-4 shadow-sm border-0">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow border-radius-lg pt-4 pb-3">
            <h1 class="text-white text-capitalize ps-3">
              Dashboard
            </h1>
          </div>

        </div>
        <div class="card-body px-0 pb-2">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="card mb-3 border-0 shadow-sm">
                      <div class="card-body">
                        <h5 class="card-title fw-bold text-black">Employee Information</h5>
                        <hr class="bg-orange" style="height: 2px; opacity: 1; background-color: #FF6B00;">
                        <p><strong>Employee ID:</strong> {{ Auth::user()->id }}</p>
                        <p><strong>Department:</strong> {{ Auth::user()->department->name ?? 'Not Assigned' }}</p>
                        <p><strong>Job Title:</strong> {{ Auth::user()->job_title }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card mb-3 border-0 shadow-sm">
                      <div class="card-body">
                        <h5 class="card-title fw-bold text-black">Quick Links</h5>
                        <hr class="bg-orange" style="height: 2px; opacity: 1; background-color: #FF6B00;">
                        <div class="d-grid gap-2 mb-3">
                          <a href="{{ route('leaves.create') }}" class="btn btn-dark">Apply for Leave</a>
                          <a href="{{ route('attendances.index') }}" class="btn btn-dark">View Attendance</a>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                          <form action="{{ route('attendance.check-in') }}" method="POST" class="d-inline me-2">
                            @csrf
                            <button type="submit" class="btn w-100" style="background-color: #FF6B00; color: white;" {{ isset($currentAttendance) && $currentAttendance->check_in ? 'disabled' : '' }}>
                              <i class="fas fa-sign-in-alt me-2"></i>Check In
                            </button>
                          </form>
                          <form action="{{ route('attendance.check-out') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-dark w-100" {{ !isset($currentAttendance) || !$currentAttendance->check_in || isset($currentAttendance) && $currentAttendance->check_out ? 'disabled' : '' }}>
                              <i class="fas fa-sign-out-alt me-2"></i>Check Out
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card border-0 shadow-sm">
              <div class="card-header d-flex justify-content-between align-items-center bg-white border-bottom-0">
                <h5 class="mb-0 fw-bold text-black">Recent Leave Requests</h5>
                <a href="{{ route('leaves.index') }}" class="btn btn-sm" style="background-color: #FF6B00; color: white;">View All</a>
              </div>
              <div class="card-body">
                @php
                $recentLeaves = Auth::user()->leaves()->latest()->take(5)->get();
                @endphp
                @if ($recentLeaves->isEmpty())
                <div class="alert text-center py-3" role="alert" style="background-color: #f8f9fa;">You have no recent leave requests.</div>
                @else
                <div class="table-responsive">
                  <table class="table align-middle mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-black fw-bold">Leave Type</th>
                        <th class="text-uppercase text-black fw-bold">Period</th>
                        <th class="text-uppercase text-black fw-bold">Days</th>
                        <th class="text-uppercase text-black fw-bold">Status</th>
                        <th class="text-uppercase text-black fw-bold">Actions</th>
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
                          <span class="badge" style="background-color: #FFC107;">Pending</span>
                          @elseif($leave->status == 'Approved')
                          <span class="badge" style="background-color: #198754;">Approved</span>
                          @elseif($leave->status == 'Rejected')
                          <span class="badge bg-danger">Rejected</span>
                          @else
                          <span class="badge bg-secondary">{{ $leave->status }}</span>
                          @endif
                        </td>
                        <td>
                          <div class="btn-group" role="group">
                            <a href="{{ route('leaves.show', $leave->id) }}" class="btn btn-sm" style="background-color: #FF6B00; color: white;">View</a>
                            @if($leave->status == 'Pending')
                            <a href="{{ route('leaves.edit', $leave->id) }}" class="btn btn-sm btn-dark">Edit</a>
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

<style>
  .bg-orange {
    background-color: #FF6B00 !important;
  }

  .text-orange {
    color: #FF6B00 !important;
  }

  .btn-orange {
    background-color: #FF6B00 !important;
    color: white !important;
  }

  .border-radius-lg {
    border-radius: 0.5rem;
  }

  .card {
    border-radius: 0.5rem;
  }

  .badge {
    font-weight: 500;
    padding: 0.55em 0.9em;
    border-radius: 0.25rem;
  }

  .table> :not(caption)>*>* {
    padding: 0.75rem 1rem;
  }
</style>