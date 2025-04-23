@extends('layouts.public')
@section('content')

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card my-4 border-0">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h1 class="text-white text-capitalize ps-3">Ticket #{{ $ticket->id }}</h1>
                    </div>
                </div>
                <div class="card-body p-4 p-lg-5">
                
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="ticket-header mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="ticket-title">{{ $ticket->title }}</h4>
                                <p class="ticket-meta">
                                    <span class="meta-item"><strong>Category:</strong> {{ $ticket->category }}</span>
                                    <span class="meta-divider">|</span>
                                    <span class="meta-item"><strong>Created:</strong> {{ $ticket->created_at->format('M d, Y H:i') }}</span>
                                </p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <div class="ticket-badges">
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
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ticket-content-card mb-4">
                        <div class="ticket-content-header">
                            <h6 class="content-title">Description</h6>
                        </div>
                        <div class="ticket-content-body">
                            <p class="ticket-description">{{ $ticket->description }}</p>
                        </div>
                    </div>

                    @if($ticket->status == 'approved')
                    <div class="ticket-status-alert status-approved-alert">
                        <h6 class="alert-title">Ticket Approved</h6>
                        <p class="alert-message mb-0">
                            This ticket was approved on {{ $ticket->approved_at->format('M d, Y H:i') }}
                            @if($ticket->approvedBy)
                            by {{ $ticket->approvedBy->name }}.
                            @endif
                        </p>
                    </div>
                    @elseif($ticket->status == 'rejected')
                    <div class="ticket-status-alert status-rejected-alert">
                        <h6 class="alert-title">Ticket Rejected</h6>
                        <p class="alert-message">
                            This ticket was rejected on {{ $ticket->rejected_at->format('M d, Y H:i') }}
                            @if($ticket->rejectedBy)
                            by {{ $ticket->rejectedBy->name }}.
                            @endif
                        </p>
                        @if($ticket->rejection_reason)
                        <strong class="reason-title">Reason:</strong>
                        <p class="rejection-reason mb-0">{{ $ticket->rejection_reason }}</p>
                        @endif
                    </div>
                    @else
                    <div class="ticket-status-alert status-pending-alert">
                        <h6 class="alert-title">Ticket Pending</h6>
                        <p class="alert-message mb-0">Your ticket is currently under review. We'll notify you once it's processed.</p>
                    </div>
                    @endif

                    @if($ticket->status == 'pending')
                    <div class="row action-buttons mt-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn submit-btn w-100">
                                <span class="btn-text">Edit Ticket</span>
                                <span class="btn-icon">→</span>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this ticket?')">
                                    <span class="btn-text">Delete Ticket</span>
                                </button>
                            </form>
                        </div>
                        <div>
                        <a href="{{ route('tickets.index') }}" class="btn btn-dark">Back to Tickets</a>
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
        --success: #28a745;
        --warning: #ffc107;
        --info: #17a2b8;
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
        background-color: rgba(255, 255, 255, 0.2);
        color: var(--white);
        padding: 8px 15px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        z-index: 3;
    }

    .back-btn:hover {
        background-color: var(--white);
        color: var(--black);
    }

    /* ===== Ticket Header ===== */
    .ticket-title {
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--black);
        margin-bottom: 0.5rem;
    }

    .ticket-meta {
        font-size: 0.95rem;
        color: var(--gray-500);
    }

    .meta-item {
        display: inline-block;
        margin-right: 5px;
    }

    .meta-divider {
        display: inline-block;
        margin: 0 8px;
        color: var(--gray-400);
    }

    /* ===== Badge Design ===== */
    .ticket-badges {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
    }

    .custom-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
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

    /* ===== Ticket Content Card ===== */
    .ticket-content-card {
        border-radius: 12px;
        border: 1px solid var(--gray-200);
        overflow: hidden;
    }

    .ticket-content-header {
        background-color: var(--gray-100);
        padding: 15px 20px;
        border-bottom: 1px solid var(--gray-200);
    }

    .content-title {
        margin: 0;
        font-weight: 600;
        color: var(--black);
    }

    .ticket-content-body {
        padding: 20px;
    }

    .ticket-description {
        margin: 0;
        line-height: 1.6;
    }

    /* ===== Alert Design ===== */
    .ticket-status-alert {
        border-radius: 12px;
        padding: 20px;
        margin-top: 25px;
        position: relative;
        overflow: hidden;
    }

    .ticket-status-alert::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 8px;
        height: 100%;
    }

    .status-approved-alert {
        background-color: rgba(52, 199, 89, 0.1);
    }

    .status-approved-alert::before {
        background-color: #34C759;
    }

    .status-rejected-alert {
        background-color: rgba(255, 59, 48, 0.1);
    }

    .status-rejected-alert::before {
        background-color: #FF3B30;
    }

    .status-pending-alert {
        background-color: rgba(88, 86, 214, 0.1);
    }

    .status-pending-alert::before {
        background-color: #5856D6;
    }

    .alert-title {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .status-approved-alert .alert-title {
        color: #28a745;
    }

    .status-rejected-alert .alert-title {
        color: #dc3545;
    }

    .status-pending-alert .alert-title {
        color: #5856D6;
    }

    .alert-message {
        margin-bottom: 0;
        font-size: 0.95rem;
    }

    .reason-title {
        display: block;
        margin: 10px 0 5px;
        font-weight: 600;
    }

    .rejection-reason {
        font-style: italic;
    }

    /* ===== Buttons Design ===== */
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
        background-color: var(--primary-light);
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
        background-color: var(--error);
        transition: all 0.4s ease;
        z-index: -1;
    }

    .cancel-btn:hover::before {
        width: 100%;
    }

    .cancel-btn:hover {
        color: var(--white);
        border-color: var(--error);
    }

    /* ===== Success Alert ===== */
    .alert-success {
        background-color: rgba(52, 199, 89, 0.1);
        border: 1px solid #34C759;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
        color: #155724;
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

        .back-btn {
            top: auto;
            bottom: 15px;
            right: 15px;
            font-size: 0.8rem;
            padding: 6px 12px;
        }

        .ticket-badges {
            margin-top: 15px;
            align-items: flex-start;
        }
    }
</style>
@endpush