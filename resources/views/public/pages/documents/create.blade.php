@extends('layouts.public')
@section('content')

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card my-4 border-0">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h1 class="text-white text-capitalize ps-3">Upload Document</h1>
                    </div>
                </div>
                <div class="card-body p-4 p-lg-5">
                    <form method="POST" action="{{ route('docs.store') }}" class="document-form" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group custom-form-group">
                                    <label for="title">Document Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter document title" required>
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group custom-form-group">
                                    <label for="document_type_id">Document Type</label>
                                    <div class="select-wrapper">
                                        <select class="form-control" id="document_type_id" name="document_type_id" required>
                                            <option value="" disabled selected>Select type of document</option>
                                            @foreach($documentTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('document_type_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group custom-form-group">
                                    <label for="expiry_date">Expiry Date</label>
                                    <div class="input-icon-wrapper">
                                        <input type="date" class="form-control" id="expiry_date" name="expiry_date">
                                        <span class="input-icon calendar-icon"></span>
                                    </div>
                                    @error('expiry_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group custom-form-group">
                                    <label for="file">Upload File</label>
                                    <input type="file" class="form-control" id="file" name="file" required>
                                    @error('file')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group custom-form-group">
                                    <label for="notes">Additional Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Any additional information about this document..."></textarea>
                                    @error('notes')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row action-buttons">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <button type="submit" class="btn submit-btn w-100">
                                    <span class="btn-text">Upload Document</span>
                                    <span class="btn-icon">→</span>
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('docs.index') }}" class="btn cancel-btn w-100">
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
    /* ===== Primary Color Settings ===== */
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
    .main-card {
        border-radius: 16px;
        background-color: var(--white);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        position: relative;
    }

    /* ===== Header Design ===== */
    .header-container {
        background-color: var(--black);
        position: relative;
        padding: 2.5rem !important;
    }

    .header-content {
        position: relative;
        z-index: 2;
    }

    .header-container::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 30%;
        height: 100%;
        background-color: var(--primary);
        clip-path: polygon(100% 0, 0 0, 100% 100%);
    }

    .header-title {
        color: #FF6B00;
        font-weight: 700;
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
    }

    /* ===== Form Input Design ===== */
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

    /* ===== Date Input Design ===== */
    .input-icon-wrapper {
        position: relative;
    }

    input[type="date"] {
        cursor: pointer;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        cursor: pointer;
    }

    .calendar-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23FF6B00' viewBox='0 0 16 16'%3E%3Cpath d='M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: center;
        pointer-events: none;
    }

    /* ===== Textarea Design ===== */
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    /* ===== Button Design ===== */
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
        background-color:var(--primary-light) ;
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
        background-color:var(--primary-light) ;
        transition: all 0.4s ease;
        z-index: -1;
    }

    .cancel-btn:hover::before {
        width: 100%;
    }

    .cancel-btn:hover {
        color: var(--white);
    }

    /* ===== Error Message Design ===== */
    .text-danger {
        color: var(--error) !important;
        font-size: 0.8rem;
        margin-top: 0.5rem;
        display: block;
    }

    /* ===== Mobile Optimizations ===== */
    @media (max-width: 768px) {
        .header-title {
            font-size: 1.8rem;
        }

        .header-container {
            padding: 2rem !important;
        }

        .card-body {
            padding: 2rem !important;
        }
    }

    /* ===== Additional Effects ===== */
    .form-control:hover {
        border-color: var(--gray-400);
    }

    .document-form {
        position: relative;
    }

    .document-form::before {
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

    .document-form::after {
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

    /* File input specific styling */
    input[type="file"] {
        padding: 10px;
        cursor: pointer;
    }

    input[type="file"]::file-selector-button {
        background-color: var(--primary-ultra-light);
        color: var(--primary);
        border: 2px solid var(--primary);
        border-radius: 8px;
        padding: 8px 16px;
        margin-right: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    input[type="file"]::file-selector-button:hover {
        background-color: var(--primary);
        color: var(--white);
    }
</style>
@endpush