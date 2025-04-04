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
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">{{ Auth::guard('admin')->user()->role  }} Details</h3>
            <a href="{{ route('hr.index') }}" class="btn btn-success btn-sm">Back to HRs</a>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 id="a" class="mb-0">HR Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center mb-4 mb-md-0">
                        <img src="{{ asset($hr->profile_picture) }}" alt="User Image" class="user-image mb-3">
                        <h5>User ID</h5>
                        <p class="text-muted mb-0">{{$hr->id}}</p>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 info-section">
                                <div class="info-label">Name</div>
                                <div class="info-value">{{ $hr->name }}</div>
                            </div>
                            <div class="col-md-6 info-section">
                                <div class="info-label">Email</div>
                                <div class="info-value">{{$hr->email}}</div>
                            </div>
                            <div class="col-md-6 info-section">
                                <div class="info-label">Joined Date</div>
                                <div class="info-value">{{ $hr->created_at->format('Y-m-d') }}</div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-end">
                <a href="{{ route('hr.edit', ['id' => $hr->id]) }}" class="btn btn-warning me-2">Edit</a>
                <form method="POST" action="{{ route('hr.soft_delete', ['id' => $hr->id]) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
               
            </div>
        </div>
        
        <div class="card shadow-sm mt-4">
            <div class="card-header">
                <h5 class="mb-0 head">Recent Activity</h5>
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