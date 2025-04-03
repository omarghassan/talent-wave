@extends('layouts.public')
@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h1 class="text-white text-capitalize ps-3">Leave Details</h1>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Leave Type:</h5>
                            <p>{{ $leave->leavetype->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Status:</h5>
                            <p>
                                @if($leave->status == 'Pending')
                                    <span class="badge bg-warning">{{ $leave->status }}</span>
                                @elseif($leave->status == 'Approved')
                                    <span class="badge bg-success">{{ $leave->status }}</span>
                                @elseif($leave->status == 'Rejected')
                                    <span class="badge bg-danger">{{ $leave->status }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Start Date:</h5>
                            <p>{{ $leave->start_date->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>End Date:</h5>
                            <p>{{ $leave->end_date->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Total Days:</h5>
                            <p>{{ $leave->total_days }}</p>
                        </div>
                        @if($leave->status == 'rejected' && !empty($leave->rejection_reason))
                        <div class="col-md-6">
                            <h5>Rejection Reason:</h5>
                            <p>{{ $leave->rejection_reason }}</p>
                        </div>
                        @endif
                    </div>
                    
                    @if(!empty($leave->reason))
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5>Reason:</h5>
                            <p>{{ $leave->reason }}</p>
                        </div>
                    </div>
                    @endif
                    
                    <div class="row mb-0">
                        <div class="col-md-12">
                            <a href="{{ route('leaves.index') }}" class="btn btn-success">Back to List</a>
                            @if($leave->status == 'Pending')
                                <a href="{{ route('leaves.edit', $leave->id) }}" class="btn btn-warning">Edit</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection