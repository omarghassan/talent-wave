@extends('layouts.public')
@section('content')

<style>
    body {
        background-color: #f8f9fa;
        color: #333;
    }

    .profile-header {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        position: relative;
        margin-bottom: 1.5rem;
        border: 1px solid #e0e0e0;
    }

    .profile-cover {
        height: 45px;
        background: linear-gradient(135deg, #343a40, #212529);;
        border-radius: 15px 15px 0 0;
        position: relative;
    }

    .profile-picture-container {
        position: relative;
        display: inline-block;
    }

    .profile-picture {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border: 5px solid #fff;
        border-radius: 50%;
        position: absolute;
        bottom: -60px;
        left: 50px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
    }

    .profile-info {
        padding: 80px 30px 30px;
    }

    .edit-profile-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 10;
        background-color: #FF8C00;
        border-color: #FF8C00;
        color: white;
        font-weight: 600;
    }

    .upload-photo-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: #000;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
        cursor: pointer;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
    }

    .profile-card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        padding: 25px;
        height: 100%;
        border: 1px solid #e0e0e0;
    }

    .profile-section-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #000;
        color: #000;
    }

    .info-label {
        font-weight: 600;
        color: #000;
    }

    .info-value {
        font-weight: 500;
        color: #333;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 15px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
    }

    .department-badge {
        background-color: rgba(255, 140, 0, 0.1);
        color: #FF8C00;
        border: 1px solid #FF8C00;
    }

    .position-badge {
        background-color: rgba(0, 0, 0, 0.1);
        color: #000;
        border: 1px solid #000;
    }

    .edit-field {
        cursor: pointer;
        color: #FF8C00;
        transition: color 0.2s;
        font-weight: 600;
    }

    .edit-field:hover {
        color: #E67300;
        text-decoration: underline;
    }


    .btn-black {
        background-color: #000;
        color: white;
        border-color: #000;
        font-weight: 600;
    }

    .btn-black:hover {
        background-color: #333;
        border-color: #333;
        color: white;
    }


    .navbar-dark {
        background-color: #000 !important;
    }


    .shadow-black {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }


    .divider-black {
        border-top: 1px solid #000;
        opacity: 0.1;
    }


    .link-black {
        color: #000;
        font-weight: 600;
    }

    .link-black:hover {
        color: #FF8C00;
        text-decoration: none;
    }
</style>

<div class="container py-5">

    <!-- Profile Header -->
    <div class="profile-header shadow-black">
        <div class="profile-cover">

        </div>
        <div class="profile-picture-container">
            <img src="{{ $user->profile_picture ? asset($user->profile_picture) : '/api/placeholder/160/160' }}"
                alt="Employee Profile Picture"
                class="profile-picture">


        </div>

        <div class="profile-info">
            <h2 class="mb-0" style="color: #000;">{{ $user->name }}</h2>
            <p class="text-muted">{{ $user->job_title }}</p>
            <div class="d-flex mt-2">
                <span class="status-badge department-badge me-2">{{ $user->department->name }}</span>
                <span class="status-badge position-badge">Full-time</span>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="row g-4">
        <!-- Personal Information -->
        <div class="col-lg-6">
            <div class="profile-card">
                <h3 class="profile-section-title">
                    <i class="bi bi-person-fill me-2" style="color: #FF8C00;"></i>Personal Information
                </h3>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <p class="info-label">Full Name :</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="info-value">{{ $user->name }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <p class="info-label">Email :</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="info-value">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <p class="info-label">Phone :</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="info-value">{{ $user->phone }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="info-label">Address :</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="info-value">{{ $user->address }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Employment Information -->
        <div class="col-lg-6">
            <div class="profile-card">
                <h3 class="profile-section-title">
                    <i class="bi bi-briefcase-fill me-2" style="color: #FF8C00;"></i>Employment Information
                </h3>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <p class="info-label">Employee ID :</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="info-value">{{ $user->id }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <p class="info-label">Department :</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="info-value">{{ $user->department->name }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <p class="info-label">Job Title :</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="info-value">{{ $user->job_title }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <p class="info-label">Salary</p>
                    </div>
                    <div class="col-sm-8">
                        <p class="info-value">{{ $user->salary }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


@endsection