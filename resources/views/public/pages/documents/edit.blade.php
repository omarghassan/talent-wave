@extends('layouts.public')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div style="
    background: linear-gradient(to right, #2c2c2c, #1a1a1a);
    border-left: 8px solid #F44336;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    padding: 20px 0;
">
                        <h1 style="
        color: #fff;
        text-transform: capitalize;
        padding-left: 24px;
        font-weight: 600;
        font-size: 30px;
        letter-spacing: 1px;
    ">
                            Edit Document
                        </h1>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <form action="{{ route('docs.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="text-black">Document Title:</h5>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $document->title) }}" required>
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-black">Document Type:</h5>
                                <div class="input-group input-group-outline mb-3">
                                    <select class="form-control @error('document_type_id') is-invalid @enderror" name="document_type_id" required>
                                        <option value="">Select Document Type</option>
                                        @foreach($documentTypes as $type)
                                        <option value="{{ $type->id }}" {{ old('document_type_id', $document->document_type_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('document_type_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="text-black">Expiry Date (if applicable):</h5>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" name="expiry_date" value="{{ old('expiry_date', $document->expiry_date ? $document->expiry_date->format('Y-m-d') : '') }}">
                                    @error('expiry_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-black">Current Status:</h5>
                                <p>
                                    @if($document->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                    @elseif($document->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                    @elseif($document->status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-black">Notes:</h5>
                                <div class="input-group input-group-outline mb-3">
                                    <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" rows="3">{{ old('notes', $document->notes) }}</textarea>
                                    @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-black">Document File:</h5>
                                <div class="mb-2">
                                    Current file: <a href="{{ Storage::url($document->file_path) }}" class="text-orange" target="_blank">View current document</a>
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="file" class="form-control @error('file') is-invalid @enderror" name="file">
                                    @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Leave empty to keep the current file. Upload a new file to replace it.</div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <a href="{{ route('docs.index') }}" class="btn btn-orange">Back to List</a>
                                <button type="submit" class="btn btn-black">Update Document</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --white: #ffffff;
        --black: #000000;
        --light-black: #212121;
        --orange: #FF5722;
        --light-orange: #FFAB91;
        --gray: #f5f5f5;
        --dark-gray: #e0e0e0;
    }

    .text-orange {
        color: var(--orange);
    }

    .btn-orange {
        background-color: var(--orange);
        color: var(--white);
        border-color: var(--orange);
        transition: all 0.3s ease;
    }

    .btn-orange:hover {
        background-color: var(--white);
        color: var(--orange);
        border-color: var(--orange);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-black {
        background-color: var(--black);
        color: var(--white);
        border-color: var(--black);
        transition: all 0.3s ease;
    }

    .btn-black:hover {
        background-color: var(--white);
        color: var(--black);
        border-color: var(--black);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .bg-black {
        background-color: var(--black);
        color: var(--white);
    }

    .bg-orange {
        background-color: var(--orange);
        color: var(--white);
    }

    .bg-light-black {
        background-color: var(--light-black);
        color: var(--white);
    }

    .text-black {
        color: var(--black);
        font-weight: 600;
    }

    .card {
        background-color: var(--white);
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .card-body p {
        font-size: 1rem;
        color: var(--light-black);
        padding-left: 5px;
        border-left: 3px solid var(--orange);
        margin-top: 5px;
    }

    .badge {
        padding: 8px 12px;
        font-size: 0.8rem;
        font-weight: 500;
        border-radius: 4px;
    }

    .border-radius-lg {
        border-radius: 8px;
    }

    .input-group-outline {
        position: relative;
    }

    .input-group-outline .form-control {
        border: 1px solid #d2d6da;
        border-radius: 0.375rem;
        padding: 0.75rem;
        box-shadow: none;
        transition: all 0.3s ease;
    }

    .input-group-outline .form-control:focus {
        border-color: var(--orange);
        box-shadow: 0 0 0 0.25rem rgba(255, 87, 34, 0.25);
    }
</style>
@endsection