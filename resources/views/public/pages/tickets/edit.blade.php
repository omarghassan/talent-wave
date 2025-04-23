@extends('layouts.public')
@section('content')

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card my-4 border-0">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h1 class="text-white text-capitalize ps-3">Edit Ticket #{{ $ticket->id }}</h1>
                    </div>
                </div>
                <div class="card-body p-4 p-lg-5">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" class="ticket-form">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group custom-form-group">
                                    <label for="title">Ticket Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $ticket->title) }}" required>
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group custom-form-group">
                                    <label for="category">Category</label>
                                    <div class="select-wrapper">
                                        <select class="form-control" id="category" name="category" required>
                                            <option value="" disabled>Select a category</option>
                                            <option value="IT Support" {{ old('category', $ticket->category) == 'IT Support' ? 'selected' : '' }}>IT Support</option>
                                            <option value="HR Issue" {{ old('category', $ticket->category) == 'HR Issue' ? 'selected' : '' }}>HR Issue</option>
                                            <option value="Request" {{ old('category', $ticket->category) == 'Request' ? 'selected' : '' }}>Request</option>
                                            <option value="Suggestion" {{ old('category', $ticket->category) == 'Suggestion' ? 'selected' : '' }}>Suggestion</option>
                                            <option value="Complaint" {{ old('category', $ticket->category) == 'Complaint' ? 'selected' : '' }}>Complaint</option>
                                            <option value="Other" {{ old('category', $ticket->category) == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                    @error('category')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group custom-form-group">
                                    <label for="priority">Priority</label>
                                    <div class="select-wrapper">
                                        <select class="form-control" id="priority" name="priority" required>
                                            <option value="" disabled>Select priority level</option>
                                            <option value="low" {{ old('priority', $ticket->priority) == 'low' ? 'selected' : '' }}>Low</option>
                                            <option value="medium" {{ old('priority', $ticket->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="high" {{ old('priority', $ticket->priority) == 'high' ? 'selected' : '' }}>High</option>
                                        </select>
                                    </div>
                                    @error('priority')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group custom-form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Please provide detailed information about your ticket..." required>{{ old('description', $ticket->description) }}</textarea>
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text mt-2">Please provide detailed information about your ticket.</div>
                                </div>
                            </div>
                        </div>

                        <div class="row action-buttons">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <button type="submit" class="btn submit-btn w-100">
                                    <span class="btn-text">Update Ticket</span>
                                    <span class="btn-icon">→</span>
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn cancel-btn w-100">
                                    <span class="btn-text">Cancel</span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* ===== Color Variables ===== */
    :root {
        --primary: #FF6B00;
        --primary-light: #FF8A3C;
        --primary-dark: #E05F00;
        --primary-ultra-light: #FFF1E6;
        --black: #000000;
        --black-soft: #212121;
        --white: #FFFFFF;
        --gray-100: #F8F9FA;
        --gray-200: #E9ECEF;
        --gray-300: #DEE2E6;
        --gray-400: #CED4DA;
        --gray-500: #ADB5BD;
        --error: #FF3B30;
    }

    body {
        background-color: #F9F9F9;
        color: var(--black-soft);
        font-family: 'Poppins', 'Segoe UI', sans-serif;
    }

    /* ===== Main Card Design ===== */
    /* .card {
        border-radius: 16px;
        background-color: var(--white);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        position: relative;
    } */

    /* ===== Header Design ===== */
    /* .card-header {
        background-color: transparent;
        border-bottom: none;
    } */

    /* .bg-gradient-dark {
        background: linear-gradient(to right, var(--black), var(--black-soft));
        position: relative;
        border-radius: 12px;
        padding: 2rem !important;
    } */

    /* .bg-gradient-dark::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 30%;
        height: 100%;
        background-color: var(--primary);
        clip-path: polygon(100% 0, 0 0, 100% 100%);
    } */

    /* .text-white {
        color: #FF6B00 !important;
        font-weight: 700;
        font-size: 2.2rem;
        position: relative;
        z-index: 2;
    } */

    /* ===== Form Fields Design ===== */
    .custom-form-group {
        margin-bottom: 1.5rem;
    }

    .custom-form-group label {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--black);
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        border: 2px solid var(--gray-200);
        border-radius: 12px;
        padding: 12px 18px;
        font-size: 1rem;
        height: auto;
        background-color: var(--white);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.2);
        border-color: var(--primary);
    }

    .form-control::placeholder {
        color: var(--gray-400);
    }

    /* ===== Select Dropdown Design ===== */
    .select-wrapper {
        position: relative;
    }

    .select-wrapper::after {
        content: "";
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid var(--primary);
        pointer-events: none;
    }

    select.form-control {
        appearance: none;
        cursor: pointer;
        padding-right: 40px;
    }

    /* ===== Textarea Design ===== */
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    /* ===== Buttons Design ===== */
    .action-buttons {
        margin-top: 2rem;
    }

    .btn {
        border-radius: 12px;
        padding: 14px 22px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .submit-btn {
        background: var(--primary);
        border: none;
        color: var(--white);
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .submit-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 0%;
        height: 100%;
        background-color: var(--primary-light);
        transition: all 0.4s ease;
        z-index: -1;
    }

    .submit-btn:hover::before {
        width: 100%;
    }

    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(255, 107, 0, 0.3);
    }

    .submit-btn .btn-icon {
        transition: transform 0.3s ease;
    }

    .submit-btn:hover .btn-icon {
        transform: translateX(5px);
    }

    .cancel-btn {
        background-color: transparent;
        border: 2px solid var(--black);
        color: var(--black);
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .cancel-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 0%;
        height: 100%;
        background-color: var(--primary-light);
        transition: all 0.4s ease;
        z-index: -1;
    }

    .cancel-btn:hover::before {
        width: 100%;
    }

    .cancel-btn:hover {
        color: var(--white);
    }

    /* ===== Error Messages Design ===== */
    .text-danger {
        color: var(--error) !important;
        font-size: 0.8rem;
        margin-top: 0.5rem;
        display: block;
    }

    /* ===== Responsive Design ===== */
    @media (max-width: 768px) {
        .text-white {
            font-size: 1.8rem;
        }

        .bg-gradient-dark {
            padding: 1.5rem !important;
        }

        .card-body {
            padding: 2rem !important;
        }
    }

    /* ===== Additional Effects ===== */
    .form-control:hover {
        border-color: var(--gray-400);
    }

    .ticket-form {
        position: relative;
    }

    .ticket-form::before {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 100px;
        height: 100px;
        background-color: var(--primary-ultra-light);
        border-radius: 50%;
        z-index: -1;
        opacity: 0.5;
    }

    .ticket-form::after {
        content: "";
        position: absolute;
        bottom: -30px;
        left: -30px;
        width: 60px;
        height: 60px;
        background-color: var(--primary-ultra-light);
        border-radius: 50%;
        z-index: -1;
        opacity: 0.5;
    }

    /* Alert styling */
    .alert-danger {
        background-color: rgba(255, 59, 48, 0.1);
        border: 1px solid var(--error);
        border-radius: 12px;
        padding: 15px;
    }

    .alert-danger ul {
        padding-left: 20px;
    }

    .form-text {
        color: var(--gray-500);
        font-size: 0.85rem;
    }

    /* Focus effects */
    .form-control:focus {
        outline: none;
    }
</style>
@endpush