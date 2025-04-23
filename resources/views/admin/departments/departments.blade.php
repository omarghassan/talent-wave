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
            <h1 class="text-white text-capitalize ps-3">Departments</h1>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="px-3">
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#departmentModal">Add new Department</button>
          </div>
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 align-middle text-center">Name</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2 align-middle text-center">Description</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($departments as $department)
                <tr>
                  <td>
                    <div class="align-middle text-center ">
                      <h6 class="text-xs font-weight-bold mb-0">{{$department->name}}</h6>
                    </div>

                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$department->description}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex justify-content-center gap-2">
                      <a href="{{ route('department.show', ['id' => $department->id]) }}" class="btn btn-sm btn-success">Show</a>
                      <a href="#"
                        class="btn btn-sm btn-warning edit-btn"
                        data-id="{{ $department->id }}"
                        data-name="{{ $department->name }}"
                        data-description="{{ $department->description }}"
                        data-bs-toggle="modal"
                        data-bs-target="#editdepartmentModal">
                        Edit
                      </a>
                      <form method="POST" action="{{ route('department.softdelete', ['id' => $department->id]) }}" class="d-inline">
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
  <!-- edit department Modal -->
  <div class="modal fade" id="editdepartmentModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 id="a" class="text-white text-capitalize ps-3">Edit Department</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="" id="editDepartmentForm">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label>Department Name</label>
              <input type="text" name="name" id="modalDeptName" class="form-control border border-secondary" required>
            </div>
            <div class="mb-3">
              <label>Description</label>
              <input type="text" name="description" id="modalDeptDesc" class="form-control border border-secondary">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success me-2">Save Changes</button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Add department Modal -->
  <div class="modal fade" id="departmentModal" tabindex="-1" aria-labelledby="departmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 id="a" class="text-white text-capitalize ps-3" id="departmentModalLabel">Add Department</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('create.department') }}">
            @csrf
            <div class="mb-3">
              <label for="departmentName" class="form-label">Department Name:</label>
              <input type="text" class="form-control border border-secondary" id="departmentName" name="name" required>
            </div>
            <div class="mb-3">
              <label for="departmentDescription" class="form-label">Department Description:</label>
              <input type="text" class="form-control border border-secondary" id="departmentDescription" name="description" required>
            </div>
            <div class="modal-footer px-0 pb-0">
              <button type="submit" class="btn btn-success me-2">Add Department</button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="pagination-dark">
    {{ $departments->links('pagination::bootstrap-4') }}
  </div>
  <script>
    document.querySelectorAll('.edit-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        // Get department data
        const id = this.getAttribute('data-id');
        const name = this.getAttribute('data-name');
        const description = this.getAttribute('data-description');

        // Fill form fields
        document.getElementById('modalDeptName').value = name;
        document.getElementById('modalDeptDesc').value = description;

        // Update form action URL
        document.getElementById('editDepartmentForm').action = `/admin/departments/${id}`;
      });
    });
  </script>
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