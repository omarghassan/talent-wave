@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h1 class="text-white text-capitalize ps-3">Edit Employee Info</h1>
                        </div>
                    </div>
                        <div class="card-body" id="o">
                            <form method="POST" action="{{ route('admin.user_update', ['id' => $user->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input name="name" type="text" class="form-control border border-secondary"
                                            id="name" value="{{ $user->name }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control border border-secondary"
                                            id="email" value="{{ $user->email }}">
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
                                    <div class="col-md-6 mb-3">
                                        <label for="department_id" class="form-label">Department</label>
                                        <select name="department_id" class="form-select border border-secondary" id="status">
                                            <option value="" selected>Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input name="password" type="password" class="form-control border border-secondary"
                                            id="function" value="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input name="password_confirmation" type="password"
                                            class="form-control border border-secondary" id="function" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input name="phone" type="number" class="form-control border border-secondary"
                                            id="employed" value="{{ $user->phone }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="salary" class="form-label">Salary</label>
                                        <input name="salary" type="number" class="form-control border border-secondary"
                                            id="employed" value="{{ $user->salary }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="jobtitle" class="form-label">Job Title</label>
                                        <input name="job_title" type="text" class="form-control border border-secondary"
                                            id="employed" value="{{ $user->job_title }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="hire_date" class="form-label">Hire date</label>
                                        <input name="hire_date" type="date" class="form-control border border-secondary"
                                            id="employed" value="{{ $user->hire_date }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="profile_picture" class="form-label">profile picture</label>
                                        <input name="profile_picture" type="text"
                                            class="form-control border border-secondary" id="employed"
                                            value="{{ $user->profile_picture }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input name="address" type="text" class="form-control border border-secondary"
                                            id="employed" value="{{ $user->address }}">
                                    </div>
                                </div>

                        </div>
                        <div class="d-flex justify-content-end mb-2 me-2">
                            <button type="submit" class="btn btn-success me-2">Save Changes</button>
                            <button type="button" class="btn btn-danger me-2">Cancel</button>
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
