<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TicketController extends Controller
{
    /**
     * Display a listing of the tickets.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        
        $query = Ticket::with(['user', 'approvedBy', 'rejectedBy']);
        
        // Filter by status if specified
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $tickets = $query->latest()->paginate(10);
        
        return view('admin.tickets.index', compact('tickets', 'status'));
    }
    
    /**
     * Display the specified ticket.
     */
    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show', compact('ticket'));
    }
    
    /**
     * Approve the specified ticket.
     */
    public function approve(Ticket $ticket)
    {
        // Check if the ticket is not already processed
        if ($ticket->status !== Ticket::STATUS_PENDING) {
            return back()->with('error', 'This ticket has already been processed.');
        }
        
        $ticket->status = Ticket::STATUS_APPROVED;
        $ticket->approved_by = Auth::guard('admin')->id();
        $ticket->approved_at = Carbon::now();
        $ticket->save();
        
        // You could add notification to the user here
        
        return back()->with('success', 'Ticket has been approved successfully.');
    }
    
    /**
     * Reject the specified ticket.
     */
    public function reject(Request $request, Ticket $ticket)
    {
        // Check if the ticket is not already processed
        if ($ticket->status !== Ticket::STATUS_PENDING) {
            return back()->with('error', 'This ticket has already been processed.');
        }
        
        // Validate rejection reason
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);
        
        $ticket->status = Ticket::STATUS_REJECTED;
        $ticket->rejected_by = Auth::guard('admin')->id();
        $ticket->rejected_at = Carbon::now();
        $ticket->rejection_reason = $validated['rejection_reason'];
        $ticket->save();
        
        // You could add notification to the user here
        
        return back()->with('success', 'Ticket has been rejected.');
    }
    
    /**
     * Download tickets as PDF
     */
    public function downloadPdf()
    {
        $tickets = Ticket::with(['user', 'approvedBy', 'rejectedBy'])->get();
        
        // Generate PDF logic goes here
        
        return back()->with('info', 'PDF download functionality to be implemented.');
    }
}