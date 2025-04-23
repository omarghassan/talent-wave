@extends('layouts.admin')
@section('content')
<style>
  .card-header {
    color: white !important;
  }
  .form-control, .form-select {
    border: 1px solid #dee2e6 !important;
  }
  .card {
    border: 1px solid #dee2e6 !important;
  }
  #head{
    color: white;
  }
  #a{
    color: white !important;
  }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 p-4">
            <div class="card">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h1 class="text-white text-capitalize ps-3">Edit HR Info</h1>
            </div>
            </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('hr.update' ,['id' => $hr->id]) }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" class="form-control" id="name" value="{{ $hr->name }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" class="form-control" id="email" value="{{ $hr->email }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="old_password">Current Password</label>
                            <input type="password" name="old_password" id="old_password" class="form-control border border-secondary" required>
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" id="function" value="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input name="password_confirmation" type="password" class="form-control" id="function" value="">
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input name="profile_picture" type="text" class="form-control" id="function" value="{{ $hr->profile_picture }}">
                            </div>
                        </div>
                        </div>
                        <div class="d-flex justify-content-end mb-2 me-2">
                            <button type="button" class="btn btn-danger me-2">Cancel</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>
                    @if ($errors->any())
    <div class="alert alert-danger">
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
