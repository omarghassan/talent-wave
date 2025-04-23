@extends('layouts.public')
@section('content')

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h1 class="text-white text-capitalize ps-3">Tickets</h1>
                    </div>

                </div>
                <div class="card-body px-3 pb-2">
                    <a href="{{ route('tickets.create') }}" class="btn btn-success">Create New Ticket</a>
                    <div class="table-responsive p-0">
                        <table class="table text-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ticket Title</th>
                                    <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th> -->
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Priority</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ $ticket->category }}</td>
                                    <!-- <td>{{ $ticket->priority }}</td> -->
                                    <td class="text-center">
                                        @if($ticket->priority == 'low')
                                        <span class="badge bg-gradient-success">Low</span>
                                        @elseif($ticket->priority == 'medium')
                                        <span class="badge bg-gradient-warning">Medium</span>
                                        @elseif($ticket->priority == 'high')
                                        <span class="badge bg-gradient-danger">High</span>
                                        @else
                                        <span class="badge bg-gradient-secondary">{{ ucfirst($ticket->priority) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($ticket->status == 'approved')
                                        <span class="badge bg-gradient-success">Approved</span>
                                        @elseif($ticket->status == 'pending')
                                        <span class="badge bg-gradient-warning">Pending</span>
                                        @elseif($ticket->status == 'rejected')
                                        <span class="badge bg-gradient-danger">Rejected</span>
                                        @else
                                        <span class="badge bg-gradient-secondary">{{ ucfirst($ticket->status) }}</span>
                                        @endif
                                    </td>
                                    <!-- <td class="{{ strtolower($ticket->status) == 'pending' ? 'status-pending' : (strtolower($ticket->status) == 'approved' ? 'status-approved' : 'status-rejected') }}">{{ $ticket->status }}</td> -->
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-success btn-sm">View</a>
                                            @if($ticket->status == 'pending')
                                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">Edit</a>
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