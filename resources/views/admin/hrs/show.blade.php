@extends('layouts.admin')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="m-0 text-dark">{{ Auth::guard('admin')->user()->role }} Details</h3>
            <a href="{{ route('hr.index') }}" class="btn btn-success btn-sm">Back to HRs</a>
        </div>
        
        <div class="card shadow-sm">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h1 class="text-white text-capitalize ps-3">HR Details </h1>
            </div>
          </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center mb-4 mb-md-0">
                        <div class="profile-image-container mb-3">
                            <img src="{{ asset($hr->profile_picture) }}" alt="User Image" class="user-image">
                        </div>
                        <h5 class="text-dark">User ID</h5>
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
                <a href="{{ route('hr.edit', ['id' => $hr->id]) }}" class="btn btn-warning me-2 equal-width-btn">Edit</a>
                <form method="POST" action="{{ route('hr.soft_delete', ['id' => $hr->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger equal-width-btn">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

<style>
    /* Main color scheme */
    :root {
        --primary-black: #000000;
        --primary-white: #ffffff;
        --primary-orange: #FF6B00;
        --light-gray: #f8f9fa;
        --medium-gray: #dee2e6;
        --dark-gray: #6c757d;
    }

    body {
        background-color: var(--light-gray);
    }

    

    .card-header {
        background-color: var(--primary-black);
        color: white !important;
        padding: 15px 20px;
    }

    .header-dark {
        background-color: var(--primary-black);
    }

    #a {
        color: white !important;
    }

    .card-body {
        padding: 25px;
    }

    /* Profile image styling */
    .profile-image-container {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto;
        border: 3px solid var(--primary-orange);
        padding: 3px;
    }

    .user-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    /* Information sections */
    .info-section {
        margin-bottom: 18px;
        padding: 10px;
        border-radius: 6px;
        background-color: var(--light-gray);
    }

    .info-label {
        font-size: 14px;
        font-weight: 600;
        color: var(--primary-orange);
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 16px;
        color: var(--primary-black);
    }

    /* Equal width buttons */
    .equal-width-btn {
        min-width: 100px;
        text-align: center;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: 500;
    }

    /* Card footer */
    .card-footer {
        border-top: 1px solid var(--medium-gray);
        padding: 15px 20px;
    }

    /* Text colors */
    .text-dark {
        color: var(--primary-black) !important;
    }

    .text-muted {
        color: var(--dark-gray) !important;
    }
    
    /* Make the form display as inline element so spacing works correctly */
    .card-footer form {
        display: inline-block;
        margin: 0;
    }

    /* Keep the original button colors */
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    
    /* Keep the success button for the Back link */
    .btn-success {
        background-color: #198754;
        border-color: #198754;
    }
</style>