@extends('layouts.admin')
@section('content')

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card my-4 border-0">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h1 class="text-white text-capitalize ps-3">Manage Tickets</h1>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Filter options -->
                    <div class="filter-container px-3 mb-4">
                        <form action="{{ route('admin.tickets.index') }}" method="GET" class="filter-form">
                            <select name="status" class="custom-select">
                                <option value="all" {{ $status == 'all' ? 'selected' : '' }}>All Tickets</option>
                                <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            <button type="submit" class="filter-btn">Filter</button>
                        </form>
                    </div>

                    @if(count($tickets) > 0)
                    <div class="table-responsive p-0">
                        <table class="table text-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employee</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Priority</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->user->name }}</td>
                                    <td>{{ Str::limit($ticket->title, 30) }}</td>
                                    <td>{{ $ticket->category }}</td>
                                    <td>
                                        <span
                                            @if($ticket->priority == 'low')
                                            <span class="badge bg-gradient-success">Low</span>
                                            @elseif($ticket->priority == 'medium')
                                            <span class="badge bg-gradient-warning">Medium</span>
                                            @elseif($ticket->priority == 'high')
                                            <span class="badge bg-gradient-danger">High</span>
                                            @else
                                            <span class="badge bg-gradient-secondary">{{ ucfirst($ticket->priority) }}</span>
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            @if($ticket->status == 'approved')
                                            <span class="badge bg-gradient-success">Approved</span>
                                            @elseif($ticket->status == 'pending')
                                            <span class="badge bg-gradient-warning">Pending</span>
                                            @elseif($ticket->status == 'rejected')
                                            <span class="badge bg-gradient-danger">Rejected</span>
                                            @else
                                            <span class="badge bg-gradient-secondary">{{ ucfirst($ticket->status) }}</span>
                                            @endif
                                        </span>
                                    </td>
                                    <td>{{ $ticket->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="action-wrapper">
                                            <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-success">View</a>

                                            @if($ticket->status == 'pending')
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#approveModal{{ $ticket->id }}">
                                                Approve
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $ticket->id }}">
                                                Reject
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- Approve Modal -->
                                <div class="modal fade" id="approveModal{{ $ticket->id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $ticket->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header approve-modal-header">
                                                <h5 class="modal-title" id="approveModalLabel{{ $ticket->id }}">Approve Ticket #{{ $ticket->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to approve this ticket?</p>
                                                <p><strong>Title:</strong> {{ $ticket->title }}</p>
                                                <p><strong>Employee:</strong> {{ $ticket->user->name }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="action-btn cancel-btn" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.tickets.approve', $ticket->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="action-btn approve-btn">Approve Ticket</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reject Modal -->
                                <div class="modal fade" id="rejectModal{{ $ticket->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $ticket->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header reject-modal-header">
                                                <h5 class="modal-title" id="rejectModalLabel{{ $ticket->id }}">Reject Ticket #{{ $ticket->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.tickets.reject', $ticket->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-body">
                                                    <p><strong>Title:</strong> {{ $ticket->title }}</p>
                                                    <p><strong>Employee:</strong> {{ $ticket->user->name }}</p>

                                                    <div class="form-group">
                                                        <label for="rejection_reason" class="form-label">Rejection Reason <span class="text-danger">*</span></label>
                                                        <textarea class="form-control custom-textarea" id="rejection_reason" name="rejection_reason" rows="3" required></textarea>
                                                        <div class="form-text">Please provide a reason for rejecting this ticket.</div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="action-btn cancel-btn" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="action-btn delete-btn">Reject Ticket</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-container">
                        {{ $tickets->links() }}
                    </div>
                    @else
                    <div class="empty-state">
                        <div class="empty-state-icon">📝</div>
                        <h3 class="empty-state-title">No Tickets Found</h3>
                        <p class="empty-state-text">No tickets found with the selected filter.</p>
                    </div>
                    @endif
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
        --success: #34C759;
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
    }

    .bg-gradient-dark {
        background: linear-gradient(to right, var(--black), var(--black-soft));
        position: relative;
        border-radius: 12px;
        padding: 2rem !important;
    }

    .bg-gradient-dark::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 30%;
        height: 100%;
        background-color: var(--primary);
        clip-path: polygon(100% 0, 0 0, 100% 100%);
    }

    .text-white {
        color: #FF6B00 !important;
        font-weight: 700;
        font-size: 2.2rem;
        position: relative;
        z-index: 2;
    } */

    /* ===== Filter Design ===== */
    .filter-container {
        margin-top: 1.5rem;
    }

    .filter-form {
        display: flex;
        gap: 10px;
        max-width: 400px;
    }

    .custom-select {
        padding: 10px 15px;
        border-radius: 8px;
        border: 1px solid var(--gray-300);
        background-color: var(--white);
        font-size: 0.95rem;
        flex: 1;
        color: var(--black-soft);
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .custom-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.2);
        outline: none;
    }

    .filter-btn {
        padding: 10px 20px;
        background-color: var(--primary-ultra-light);
        color: var(--primary);
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-btn:hover {
        background-color: var(--primary);
        color: var(--white);
    }

    /* ===== Table Design ===== */
    .custom-table-responsive {
        overflow-x: auto;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-top: 1.5rem;
    }

    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background-color: var(--white);
    }

    .custom-table thead th {
        padding: 16px 20px;
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--black-soft);
        background-color: var(--gray-100);
        border-bottom: 2px solid var(--gray-200);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .custom-table thead th:first-child {
        border-top-left-radius: 12px;
    }

    .custom-table thead th:last-child {
        border-top-right-radius: 12px;
    }

    .custom-table tbody tr {
        transition: all 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background-color: var(--primary-ultra-light);
    }

    .custom-table tbody td {
        padding: 14px 20px;
        font-size: 0.95rem;
        color: var(--black-soft);
        border-bottom: 1px solid var(--gray-200);
        vertical-align: middle;
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .custom-table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 12px;
    }

    .custom-table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 12px;
    }

    .title-cell {
        font-weight: 600;
        max-width: 250px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ===== Badge Design ===== */
    .custom-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.8rem;
        text-align: center;
        min-width: 80px;
    }

    .priority-badge {
        color: var(--white);
    }

    .priority-high {
        background-color: #FF3B30;
    }

    .priority-medium {
        background-color: #FF9500;
        color: var(--black-soft);
    }

    .priority-low {
        background-color: #34C759;
    }

    .status-badge {
        color: var(--white);
    }

    .status-pending {
        background-color: #5856D6;
    }

    .status-approved {
        background-color: #34C759;
    }

    .status-rejected {
        background-color: #FF3B30;
    }

    /* ===== Action Buttons ===== */
    .action-wrapper {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .action-btn {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        border: none;
    }

    .view-btn {
        background-color: var(--primary-ultra-light);
        color: var(--primary);
    }

    .view-btn:hover {
        background-color: var(--primary);
        color: var(--white);
    }

    .approve-btn {
        background-color: rgba(52, 199, 89, 0.1);
        color: #34C759;
    }

    .approve-btn:hover {
        background-color: #34C759;
        color: var(--white);
    }

    .delete-btn {
        background-color: rgba(255, 59, 48, 0.1);
        color: #FF3B30;
    }

    .delete-btn:hover {
        background-color: #FF3B30;
        color: var(--white);
    }

    .cancel-btn {
        background-color: var(--gray-200);
        color: var(--black-soft);
    }

    .cancel-btn:hover {
        background-color: var(--gray-400);
    }

    /* ===== Modal Design ===== */
    .modal-content {
        border-radius: 16px;
        border: none;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .approve-modal-header {
        background-color: #34C759;
        color: var(--white);
        padding: 1.2rem;
        border-bottom: none;
    }

    .reject-modal-header {
        background-color: #FF3B30;
        color: var(--white);
        padding: 1.2rem;
        border-bottom: none;
    }

    .modal-title {
        font-weight: 700;
        font-size: 1.2rem;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--gray-200);
    }

    .custom-textarea {
        border-radius: 10px;
        border: 1px solid var(--gray-300);
        padding: 12px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .custom-textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.2);
        outline: none;
    }

    .form-text {
        font-size: 0.85rem;
        color: var(--gray-500);
        margin-top: 5px;
    }

    /* ===== Empty State ===== */
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        text-align: center;
    }

    .empty-state-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .empty-state-title {
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: var(--black);
    }

    .empty-state-text {
        color: var(--gray-500);
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }

    /* ===== Alert Design ===== */
    .alert {
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
        position: relative;
    }

    .alert-success {
        background-color: rgba(52, 199, 89, 0.1);
        border: 1px solid var(--success);
        color: #155724;
    }

    .alert-danger {
        background-color: rgba(255, 59, 48, 0.1);
        border: 1px solid var(--error);
        color: #721c24;
    }

    /* ===== Pagination ===== */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
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

        .custom-table {
            min-width: 900px;
        }

        .action-wrapper {
            flex-direction: column;
        }

        .action-btn {
            width: 100%;
        }
    }
</style>