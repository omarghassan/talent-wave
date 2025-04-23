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
      </div>
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h1 class="text-white text-capitalize ps-3">HRs</h1>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="px-3">
            <a class="btn bg-gradient-dark" href="{{ route('hr.create') }}" type="button">Add new HR</a>
          </div>
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Name</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">E-mail</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Phone</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Salary</th>

                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($hrs as $hr)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset($hr->profile_picture) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{$hr->name}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$hr->email}}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0">{{$hr->created_at}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$hr->updated_at}}</p>
                  </td>

                  <td class="align-middle text-center">
                    <div class="d-flex justify-content-center gap-2">
                      <a href="{{ route('hr.show', ['id' => $hr->id]) }}" class="btn btn-sm btn-success">Show</a>
                      <a href="{{ route('hr.edit', ['id' => $hr->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                      <form method="POST" action="{{ route('hr.soft_delete', ['id' => $hr->id]) }}" class="d-inline">
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
  <div class="pagination-dark">
    {{ $hrs->links('pagination::bootstrap-4') }}
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