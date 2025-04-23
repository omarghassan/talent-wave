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
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h1 class="text-white text-capitalize ps-3">Deleted Departments</h1>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7">Name</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Description</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Create Date</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Edit Date</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($departments as $department)
                <tr>
                  <td>
                    <div class="d-flex flex-column justify-content-center align-middle text-center">
                      <h6 class="text-xs font-weight-bold mb-0">{{$department->name}}</h6>
                    </div>

                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$department->description}}</p>
                  </td>
                  <td class="align-middle text-center ">
                    <p class="text-xs font-weight-bold mb-0">{{$department->created_at->diffForHumans()}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$department->updated_at->diffForHumans()}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex justify-content-center gap-2">
                      <form method="POST" action="{{ route('department.restore', ['id' => $department->id]) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Restore</button>
                      </form>
                      <form method="POST" action="{{ route('department.delete', ['id' => $department->id]) }}" class="d-inline">
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
    {{ $departments->links('pagination::bootstrap-4') }}
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
  @endsection