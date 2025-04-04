@extends('layouts.admin')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="m-0">User Details</h3>
            <a href="{{ route('all_users') }}" class="btn btn-outline-secondary btn-sm">Back to Users</a>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Employee Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center mb-4 mb-md-0">
                        <img src="{{ asset($user->profile_picture) }}" alt="User Image" class="user-image mb-3">
                        <h5>User ID</h5>
                        <p class="text-muted mb-0">{{$user->id}}</p>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 info-section">
                                <div class="info-label">Name</div>
                                <div class="info-value">{{ $user->name }}</div>
                            </div>
                            <div class="col-md-6 info-section">
                                <div class="info-label">Email</div>
                                <div class="info-value">{{$user->email}}</div>
                            </div>
                            <div class="col-md-6 info-section">
                                <div class="info-label">Phone</div>
                                <div class="info-value">{{ $user->phone }}</div>
                            </div>
                            <div class="col-md-6 info-section">
                                <div class="info-label">Salary</div>
                                <div class="info-value">{{ $user->salary }}</div>
                            </div>
                            <div class="col-md-6 info-section">
                                <div class="info-label">Department</div>
                                <div class="info-value">{{ $user->department->name }}</div>
                            </div>
                            <div class="col-md-6 info-section">
                                <div class="info-label">Joined Date</div>
                                <div class="info-value">{{ $user->created_at }}</div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-end">
                <a href="{{ route('admin.edit_user', ['id' => $user->id]) }}" class="btn btn-outline-primary me-2">Edit</a>
                <form method="POST" action="{{ route('admin.user_softdelete', ['id' => $user->id]) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-outline-danger">Delete</button>
                    </form>
               
            </div>
        </div>
        
        <div class="card shadow-sm mt-4">
            <div class="card-header">
                <h5 class="mb-0">Recent Activity</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Activity</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>28 Mar, 2025</td>
                                <td>Updated profile information</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>24 Mar, 2025</td>
                                <td>Submitted quarterly report</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>15 Mar, 2025</td>
                                <td>Changed department</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    @endsection