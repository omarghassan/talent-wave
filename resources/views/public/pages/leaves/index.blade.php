@extends('layouts.public')
@section('content')

<div class="container-fluid py-2">
  <div class="row">
    <div class="col-12">
      <a href="{{ route('leaves.create') }}" class="btn btn-success">Request Leave</a>
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h1 class="text-white text-capitalize ps-3">Leaves</h1>

          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table text-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Leave Type</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Start Date</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">End Date</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Days</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($leaves as $leave)
                <tr>
                  <td>{{ $leave->leaveType->name }}</td>
                  <td>{{ $leave->start_date->format('d/m/Y') }}</td>
                  <td>{{ $leave->end_date->format('d/m/Y') }}</td>
                  <td>{{ $leave->total_days }}</td>
                  <td>{{ $leave->status }}</td>
                  <td>
                    <div class="btn-group" role="group">
                      <a href="{{ route('leaves.show', $leave->id) }}" class="btn btn-success btn-sm">View</a>
                      @if($leave->status == 'Pending')
                      <a href="{{ route('leaves.edit', $leave->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      @endif
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection