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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 id="a" class="mb-0">Employee Leave Balances ({{ $year }})</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    <form method="POST" action="{{ route('admin.leave-balances.update') }}" class="mb-4">
                        @csrf
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label">Employee</label>
                                <select name="user_id" class="form-control" required>
                                    @if ($balance)
                                    <option selected value="{{ $balance->user->id }}">{{ $balance->user->name }}</option>
                                    @else
                                    <option value="">Select Employee</option>
                                    @endif
                                    
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Leave Type</label>
                                <select name="leave_type_id" class="form-control" required>
                                    <option value="">Select Leave Type</option>
                                    @foreach ($leaveTypes as $leaveType)
                                        <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Year</label>
                                <input type="number" name="year" class="form-control" value="{{ $year }}" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Allocated Days</label>
                                <input type="number" name="allocated" class="form-control" step="0.01" min="0" required>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Update</button>
                            </div>
                            @endsection