@extends('layouts.admin')
@section('content')

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card my-4 border-0">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h1 class="text-white text-capitalize ps-3">Ticket #{{ $ticket->id }} Details</h1>
                    </div>
                </div>
                <div class="card-body p-4 p-lg-5">
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

                    <div class="ticket-header">
                        <div class="ticket-info">
                            <h2 class="ticket-title">{{ $ticket->title }}</h2>
                            <div class="ticket-meta">
                                <span class="meta-item">
                                    <i class="meta-icon category-icon"></i>
                                    <span class="meta-text">{{ $ticket->category }}</span>
                                </span>
                                <span class="meta-item">
                                    <i class="meta-icon date-icon"></i>
                                    <span class="meta-text">{{ $ticket->created_at->format('M d, Y H:i') }}</span>
                                </span>
                            </div>
                        </div>
                        <div class="ticket-status">
                            <span class="custom-badge priority-badge 
                                @if($ticket->priority == 'high') priority-high
                                @elseif($ticket->priority == 'medium') priority-medium
                                @else priority-low @endif">
                                Priority: {{ ucfirst($ticket->priority) }}
                            </span>
                            <span class="custom-badge status-badge
                                @if($ticket->status == 'pending') status-pending
                                @elseif($ticket->status == 'approved') status-approved
                                @else status-rejected @endif">
                                Status: {{ ucfirst($ticket->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="info-cards">
                        <div class="info-card employee-card">
                            <div class="info-card-header">
                                <h3 class="info-card-title">Employee Information</h3>
                            </div>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <span class="info-label">Name:</span>
                                    <span class="info-value">{{ $ticket->user->name }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Email:</span>
                                    <span class="info-value">{{ $ticket->user->email }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Department:</span>
                                    <span class="info-value">{{ $ticket->user->department ? $ticket->user->department->name : 'N/A' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Employee ID:</span>
                                    <span class="info-value">{{ $ticket->user->id }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="info-card ticket-card">
                            <div class="info-card-header">
                                <h3 class="info-card-title">Ticket Information</h3>
                            </div>
                            <div class="info-card-body">
                                <div class="info-item">
                                    <span class="info-label">Created At:</span>
                                    <span class="info-value">{{ $ticket->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Status:</span>
                                    <span class="info-value">{{ ucfirst($ticket->status) }}</span>
                                </div>
                                @if($ticket->status == 'approved')
                                <div class="info-item">
                                    <span class="info-label">Approved By:</span>
                                    <span class="info-value">{{ $ticket->approvedBy ? $ticket->approvedBy->name : 'N/A' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Approved At:</span>
                                    <span class="info-value">{{ $ticket->approved_at->format('M d, Y H:i') }}</span>
                                </div>
                                @elseif($ticket->status == 'rejected')
                                <div class="info-item">
                                    <span class="info-label">Rejected By:</span>
                                    <span class="info-value">{{ $ticket->rejectedBy ? $ticket->rejectedBy->name : 'N/A' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Rejected At:</span>
                                    <span class="info-value">{{ $ticket->rejected_at->format('M d, Y H:i') }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="description-card">
                        <div class="description-header">
                            <h3 class="description-title">Description</h3>
                        </div>
                        <div class="description-body">
                            <p class="description-text">{{ $ticket->description }}</p>
                        </div>
                    </div>

                    @if($ticket->status == 'rejected' && $ticket->rejection_reason)
                    <div class="rejection-card">
                        <div class="rejection-header">
                            <h3 class="rejection-title">Rejection Reason</h3>
                        </div>
                        <div class="rejection-body">
                            <p class="rejection-text">{{ $ticket->rejection_reason }}</p>
                        </div>
                    </div>
                    @endif

                    @if($ticket->status == 'pending')
                    <div class="action-buttons">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveModal">
                            Approve Ticket
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                            Reject Ticket
                        </button>
                        <a href="{{ route('admin.tickets.index') }}" class="btn btn-dark">
                            <span class="btn-icon">←</span>
                            <span class="btn-text">Back to Tickets</span>
                        </a>
                    </div>

                    <!-- Approve Modal -->
                    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header approve-modal-header">
                                    <h5 class="modal-title" id="approveModalLabel">Approve Ticket #{{ $ticket->id }}</h5>
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
                    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header reject-modal-header">
                                    <h5 class="modal-title" id="rejectModalLabel">Reject Ticket #{{ $ticket->id }}</h5>
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

    .back-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: var(--white);
        color: var(--primary);
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        z-index: 3;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .back-btn:hover {
        background-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(255, 107, 0, 0.4);
        color: var(--white);
    }

    .back-btn .btn-icon {
        font-size: 1.2rem;
        line-height: 1;
    }

    /* ===== Ticket Header ===== */
    .ticket-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .ticket-info {
        flex: 1;
    }

    .ticket-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--black);
        margin-bottom: 0.75rem;
    }

    .ticket-meta {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        color: var(--gray-500);
        font-size: 0.95rem;
    }

    .meta-icon {
        display: inline-block;
        width: 16px;
        height: 16px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }

    .category-icon {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23ADB5BD' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z'%3E%3C/path%3E%3Cline x1='4' y1='22' x2='4' y2='15'%3E%3C/line%3E%3C/svg%3E");
    }

    .date-icon {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23ADB5BD' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'%3E%3C/rect%3E%3Cline x1='16' y1='2' x2='16' y2='6'%3E%3C/line%3E%3Cline x1='8' y1='2' x2='8' y2='6'%3E%3C/line%3E%3Cline x1='3' y1='10' x2='21' y2='10'%3E%3C/line%3E%3C/svg%3E");
    }

    .ticket-status {
        display: flex;
        flex-direction: column;
        gap: 10px;
        min-width: 160px;
    }

    /* ===== Info Cards ===== */
    .info-cards {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-card {
        background-color: var(--white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .info-card-header {
        background-color: var(--gray-100);
        padding: 15px 20px;
        border-bottom: 1px solid var(--gray-200);
    }

    .info-card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--black-soft);
        margin: 0;
    }

    .info-card-body {
        padding: 15px 20px;
    }

    .info-item {
        display: flex;
        margin-bottom: 10px;
    }

    .info-item:last-child {
        margin-bottom: 0;
    }

    .info-label {
        font-weight: 600;
        color: var(--black-soft);
        width: 120px;
        flex-shrink: 0;
    }

    .info-value {
        color: var(--gray-500);
    }

    /* ===== Description Card ===== */
    .description-card {
        background-color: var(--white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
    }

    .description-header {
        background-color: var(--gray-100);
        padding: 15px 20px;
        border-bottom: 1px solid var(--gray-200);
    }

    .description-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--black-soft);
        margin: 0;
    }

    .description-body {
        padding: 20px;
    }

    .description-text {
        margin: 0;
        line-height: 1.6;
        color: var(--gray-500);
    }

    /* ===== Rejection Card ===== */
    .rejection-card {
        background-color: var(--white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
        border-left: 4px solid var(--error);
    }

    .rejection-header {
        background-color: rgba(255, 59, 48, 0.1);
        padding: 15px 20px;
        border-bottom: 1px solid rgba(255, 59, 48, 0.2);
    }

    .rejection-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--error);
        margin: 0;
    }

    .rejection-body {
        padding: 20px;
    }

    .rejection-text {
        margin: 0;
        line-height: 1.6;
        color: var(--gray-500);
    }

    /* ===== Badge Design ===== */
    .custom-badge {
        display: inline-block;
        padding: 8px 14px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
        text-align: center;
        width: 100%;
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
    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .action-btn {
        display: inline-block;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 600;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        border: none;
    }

    .approve-btn {
        background-color: rgba(52, 199, 89, 0.1);
        color: #34C759;
    }

    .approve-btn:hover {
        background-color: #34C759;
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(52, 199, 89, 0.3);
    }

    .delete-btn {
        background-color: rgba(255, 59, 48, 0.1);
        color: #FF3B30;
    }

    .delete-btn:hover {
        background-color: #FF3B30;
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(255, 59, 48, 0.3);
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
        resize: vertical;
        min-height: 100px;
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

    /* ===== Responsive Design ===== */
    @media (max-width: 992px) {
        .info-cards {
            grid-template-columns: 1fr;
        }
    }

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

        .back-btn {
            top: auto;
            bottom: 15px;
            right: 15px;
            font-size: 0.8rem;
            padding: 8px 15px;
        }

        .ticket-header {
            flex-direction: column;
        }

        .ticket-status {
            width: 100%;
        }

        .ticket-meta {
            flex-direction: column;
            gap: 0.5rem;
        }

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .action-btn {
            width: 100%;
        }
    }
</style>