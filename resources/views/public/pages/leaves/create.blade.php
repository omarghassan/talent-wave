@extends('layouts.public')
@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h1 class="text-white text-capitalize ps-3">Request Leave</h1>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <form method="POST" action="{{ route('leaves.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label for="leave_type_id">Leave Type</label>
                                    <select class="form-control" id="leave_type_id" name="leave_type_id" required>
                                        <option value="">Select Leave Type</option>
                                        @foreach($leaveTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('leave_type_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-static mb-4">
                                    <label for="end_date">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                    @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="input-group input-group-static mb-4">
                                    <label for="reason">Reason</label>
                                    <textarea class="form-control" id="reason" name="reason" rows="4"></textarea>
                                    @error('reason')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Submit Request</button>
                                <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection