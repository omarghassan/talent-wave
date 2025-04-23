@extends('layouts.admin')
@section('content')
@if (session('message'))
<div class="alert alert-success text-center" role="alert">
  {{ session('message') }}
</div>
@endif
<style>
  #a {
    background-color: transparent !important;
  }

  body {
    background-color: #f5f5f5 !important;
  }
</style>

<div class="container-fluid py-2">
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div id="a" class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Today's Money</p>
              <h4 class="mb-0">absent today</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">weekend</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0">{{ $absentEmployees->count() }}</p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div id="a" class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Today's Users</p>
              <h4 class="mb-0">Present Today</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">person</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 ">{{ $presentEmployees->count() }}</p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div id="a" class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Ads Views</p>
              <h4 class="mb-0">On Leave Today</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">leaderboard</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0">{{ $onLeaveEmployees->count() }}</p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div id="a" class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Sales</p>
              <h4 class="mb-0">Late Today</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">weekend</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm">{{ $lateEmployees->count() }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid py-2">
  <div class="row">
    <div class="col-12">
      <div class="container-fluid">
        <div class=" p-2 row mb-3 align-items-center">
          <div class="col-12">
            <form method="GET" action="" id="authorsSearchForm" class="authorsForm border rounded p-3 bg-gray-200">
              <div class="row g-2 mb-3">
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-0">
                  <label class="d-md-none small">Start Date</label>
                  <input type="date" name="start_date" class="form-control form-control-sm border border-secondary" value="{{ request('start_date') }}">
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-0">
                  <label class="d-md-none small">End Date</label>
                  <input type="date" name="end_date" class="form-control form-control-sm border border-secondary" value="{{ request('end_date') }}">
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-0">
                  <input type="text"
                    name="user_search"
                    class="form-control form-control-sm border border-secondary"
                    placeholder="Enter name or employee ID"
                    value="{{ request('user_search') }}">
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-0">
                  <label class="d-md-none small">Status</label>
                  <select name="status" class="form-control form-control-sm border border-secondary">
                    <option value="">All Statuses</option>
                    <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Present</option>
                    <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                    <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Late</option>
                    <option value="half_day" {{ request('status') == 'half_day' ? 'selected' : '' }}>Half Day</option>
                    <option value="on_leave" {{ request('status') == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                  </select>
                </div>
              </div>

              <div class="d-flex flex-wrap gap-2 mb-2">
                <button type="submit" class="btn btn-primary btn-sm border">Filter</button>
                <a href="{{ url()->current() }}" class="btn btn-secondary btn-sm border">Reset</a>
                <!-- Export button for mobile -->
                <a href="{{ route('attendance.pdf') }}" class="btn btn-danger btn-sm d-md-none ms-auto border">
                  <i class="fas fa-file-pdf"></i> Export to PDF
                </a>
                <div class="d-none d-md-block">
                  <a href="{{ route('attendance.pdf') }}" class="btn btn-danger btn-sm">
                    <i class="fas fa-file-pdf"></i> Export to PDF
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h1 class="text-white text-capitalize ps-3">Attendance Records</h1>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Employee</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Date</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Check In</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Check Out</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Total Hours</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Overtime</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Shortage</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($attendances as $attendance)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset($attendance->user->profile_picture ?? 'assets/img/default-profile.png') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ isset($attendance->user->name) ? $attendance->user->name : " " }}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $attendance->date->format('Y-m-d') }}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0">{{ $attendance->check_in ? $attendance->check_in->format('H:i') : '-' }}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{ $attendance->check_out ? $attendance->check_out->format('H:i') : '-' }}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{ $attendance->total_hours ?? '-' }}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{ $attendance->overtime_hours ?? '-' }}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{ $attendance->shortage_hours ?? '-' }}</p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="badge
                                            @if($attendance->status == 'present') bg-success
                                            @elseif($attendance->status == 'absent') bg-danger
                                            @elseif($attendance->status == 'late') bg-warning
                                            @elseif($attendance->status == 'half_day') bg-info
                                            @elseif($attendance->status == 'on_leave') bg-secondary
                                            @endif ">
                      {{ ucfirst(str_replace('_', ' ', $attendance->status)) }}
                    </span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="pagination-dark">
    {{ $attendances->links('pagination::bootstrap-4') }}
  </div>
</div>

<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
@endsection