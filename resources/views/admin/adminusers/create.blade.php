@extends('layouts.admin')
@section('content')
<style>
  .card-header {
    color: white !important;
  }

  .form-control,
  .form-select {
    border: 1px solid #dee2e6 !important;
  }

  .card {
    border: 1px solid #dee2e6 !important;
  }

  #head {
    color: white;
  }
</style>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h1 class="text-white text-capitalize ps-3">New Employee</h1>

          </div>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('add_new_employee') }}">
            @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input name="name" type="text" class="form-control border border-secondary" id="name" value="">
              </div>
              <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control border border-secondary" id="email" value="">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control border border-secondary" id="function" value="">
              </div>
              <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password_confirmation" type="password" class="form-control border border-secondary" id="function" value="">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input name="phone" type="number" class="form-control border border-secondary" id="employed" value="">
              </div>
              <div class="col-md-6 mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input name="salary" type="number" class="form-control border border-secondary" id="employed" value="">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="jobtitle" class="form-label">Job Title</label>
                <input name="job_title" type="text" class="form-control border border-secondary" id="employed" value="">
              </div>
              <div class="col-md-6 mb-3">
                <label for="hire_date" class="form-label">Hire date</label>
                <input name="hire_date" type="date" class="form-control border border-secondary" id="employed" value="">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="profile_picture" class="form-label">profile picture</label>
                <input name="profile_picture" type="text" class="form-control border border-secondary" id="employed" value="">
              </div>
              <div class="col-md-6 mb-3">
                <label for="address" class="form-label">Address</label>
                <input name="address" type="text" class="form-control border border-secondary" id="employed" value="">
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="department_id" class="form-label">Department</label>
              <select name="department_id" class="form-select border border-secondary" id="status">
                <option value="" selected>Select Department</option>
                @foreach ($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="d-flex justify-content-end mb-2 me-2">
              <button type="button" class="btn btn-danger me-2 border border-secondary">Cancel</button>
              <button type="submit" class="btn btn-success border border-primary">Save Changes</button>
            </div>
          </form>
          @if ($errors->any())
          <div class="alert alert-danger border border-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection