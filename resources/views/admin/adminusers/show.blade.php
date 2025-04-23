@extends('layouts.admin')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="m-0 text-dark">User Details</h3>
            <a href="{{ route('all_users') }}" class="btn btn-outline-dark btn-sm">Back to Users</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header header-dark">
                <h5 id="a" class="mb-0">Employee Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center mb-4 mb-md-0">
                        <div class="profile-image-container mb-3">
                            <img src="{{ asset($user->profile_picture) }}" alt="User Image" class="user-image">
                        </div>
                        <h5 class="text-dark">User ID</h5>
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
                                @if (Auth::guard('admin')->user()->role =='hr')
                                <div class="info-value">{{ $user->salary }}</div>
                                @else
                                <div class="info-value">****</div>
                                @endif

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
    <a href="{{ route('admin.edit_user', ['id' => $user->id]) }}" class="btn btn-warning me-2 equal-width-btn">Edit</a>
    <form method="POST" action="{{ route('admin.user_softdelete', ['id' => $user->id]) }}">
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

    .card {
        border: 1px solid var(--medium-gray) !important;
        border-radius: 8px;
        overflow: hidden;
    }

    .card-header.header-dark {
        background-color: var(--primary-black);
        color: var(--primary-white) !important;
        padding: 15px 20px;
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

    /* Button styling */
    .btn-orange {
        background-color: var(--primary-orange);
        border-color: var(--primary-orange);
        color: var(--primary-white);
    }

    .btn-orange:hover {
        background-color: #e05d00;
        border-color: #e05d00;
        color: var(--primary-white);
    }

    .btn-outline-dark {
        color: var(--primary-black);
        border-color: var(--primary-black);
    }

    .btn-outline-dark:hover {
        background-color: var(--primary-black);
        color: var(--primary-white);
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

    .equal-width-btn {
    min-width: 100px;
    text-align: center;
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 500;
}

/* Optional: Make the form and button display as inline elements so spacing works correctly */
.card-footer form {
    display: inline-block;
    margin: 0;
}
#a{
    color: white;
}
</style>
