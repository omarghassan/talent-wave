@extends('layouts.admin')
@section('content')
@if (session('message'))
<div class="alert alert-success text-center" role="alert">
  {{ session('message') }}
</div>
@endif
<div class="container-fluid py-2">
  <div class="row">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between mb-4">


        <div id="employeesSearchContainer">
          <div id="employeesFilterGroup">
            <form method="GET" action="{{ route('admin.leave-balances.index') }}" id="employeesSearchForm" class="employeesForm">
              <div id="employeesSearchWrapper">
                <input name="search" type="text" id="employeesSearchInput" placeholder="Search employees...">
                <button type="submit" id="employeesSearchButton">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#777" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                  </svg>
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="d-flex justify-content-between gap-2">
          <a href="{{ route('leave.pdf') }}" class="btn btn-success">
            <i class="fas fa-file-pdf"></i> Export to PDF
          </a>

        </div>
      </div>
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h1 class="text-white text-capitalize ps-3">Leave Balances</h1>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Employee</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Leave Type</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">allocated</th>

                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">used</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">remaining</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($leaveBalances as $leave)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset($leave->user->profile_picture) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{$leave->user->name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$leave->leave_type->name}}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0">{{$leave->total_allocated}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$leave->total_used}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$leave->total_remaining}}</p>
                  </td>
                  <td class="align-middle text-center">

                    <a class="btn btn-warning btn-sm" href="{{ route('balance.update' ,['id' => $leave->id]) }}">Update</a>
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
    {{ $leaveBalances->links('pagination::bootstrap-4') }}
  </div>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
  @endsection