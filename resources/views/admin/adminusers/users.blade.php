@extends('layouts.admin')
@section('content')

<div class="container-fluid py-2">
  <div class="row">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between mb-4">

        <div id="employeesSearchContainer">
          <div id="employeesFilterGroup">
            <form method="GET" action="{{ route('all_users') }}" id="employeesSearchForm" class="employeesForm">
              <div id="employeesSearchWrapper">
                <input name="search" type="text" id="employeesSearchInput" placeholder="Search employees">
                <button type="submit" id="employeesSearchButton">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#777" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                  </svg>
                </button>
              </div>
            </form>

            <!-- Department Filter Form -->
            <form id="employeesDepartmentForm" class="employeesForm">
              <select name="department_id" id="employeesDepartmentFilter" onchange="this.form.submit()">
                <option selected>All Departments</option>
                @foreach ($departments as $department)
                <option value="{{ $department->id }}">{{$department->name}}</option>
                @endforeach
              </select>
            </form>
          </div>
        </div>
        <div class="d-flex justify-content-between gap-2">
          <a href="{{ route('employees.download.pdf') }}" class="btn btn-primary">
            <i class="fas fa-file-pdf"></i> Export to PDF
          </a>
          <a class="btn bg-gradient-dark" href="{{ route('admin.create') }}" type="button">Add new user</a>
        </div>
      </div>

      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h1 class="text-white text-capitalize ps-3">Employees</h1>

          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table text-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employee Name</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Salary</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Department</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hire Date</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset($user->profile_picture) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{$user->name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0">{{$user->email}}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0">{{$user->phone}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$user->salary}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{isset($user->department->name) ? $user->department->name : " "}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{isset($user->hire_date) ? $user->hire_date : " "}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{isset($user->address) ? $user->address : " "}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex justify-content-center gap-2">
                      <a href="{{ route('admin.show_user', ['id' => $user->id]) }}" class="btn btn-sm btn-success">Show</a>
                      <a href="{{ route('admin.edit_user', ['id' => $user->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                      <form method="POST" action="{{ route('admin.user_softdelete', ['id' => $user->id]) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                      </form>
                    </div>
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
</div>

<div class="pagination-dark">
  {{ $users->links('pagination::bootstrap-4') }}
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