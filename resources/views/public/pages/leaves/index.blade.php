@extends('layouts.public')
@section('content')

<div class="container-fluid py-2">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h1 style="
        color: white;
        text-transform: capitalize;
        padding-left: 20px;
        font-weight: bold;
        font-size: 32px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.4);
        ">
              Leaves
            </h1>
          </div>

        </div>
        <div class="card-body px-3 pb-2">
          <a href="{{ route('leaves.create') }}" class="btn btn-success">Request Leave</a>
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
                  <td class="text-center">
                    @if($leave->status == 'Approved')
                    <span class="badge bg-gradient-success">Approved</span>
                    @elseif($leave->status == 'Pending')
                    <span class="badge bg-gradient-warning">Pending</span>
                    @elseif($leave->status == 'Rejected')
                    <span class="badge bg-gradient-danger">Rejected</span>
                    @else
                    <span class="badge bg-gradient-secondary">{{ ucfirst($leave->status) }}</span>
                    @endif
                  </td>
                  <!-- <td class="{{ strtolower($leave->status) == 'pending' ? 'status-pending' : (strtolower($leave->status) == 'approved' ? 'status-approved' : 'status-rejected') }}">{{ $leave->status }}</td> -->
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