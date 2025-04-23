<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $tickets = $user->tickets()->latest()->get();
        
        return view('public.pages.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('public.pages.tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'category' => 'required|string|max:100',
        ]);
        
        $ticket = new Ticket($validated);
        $ticket->user_id = Auth::id();
        $ticket->status = Ticket::STATUS_PENDING;
        $ticket->save();
        
        return redirect()->route('tickets.index')
            ->with('success', 'Ticket submitted successfully! Waiting for approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        // Make sure the user can only see their own tickets
        if ($ticket->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('public.pages.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        // Make sure the user can only edit their pending tickets
        if ($ticket->user_id !== Auth::id() || $ticket->status !== Ticket::STATUS_PENDING) {
            abort(403, 'Unauthorized action. You can only edit pending tickets.');
        }
        
        return view('public.pages.tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        // Make sure the user can only update their pending tickets
        if ($ticket->user_id !== Auth::id() || $ticket->status !== Ticket::STATUS_PENDING) {
            abort(403, 'Unauthorized action. You can only update pending tickets.');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'category' => 'required|string|max:100',
        ]);
        
        $ticket->update($validated);
        
        return redirect()->route('tickets.index')
            ->with('success', 'Ticket updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        // Make sure the user can only delete their pending tickets
        if ($ticket->user_id !== Auth::id() || $ticket->status !== Ticket::STATUS_PENDING) {
            abort(403, 'Unauthorized action. You can only delete pending tickets.');
        }
        
        $ticket->delete();
        
        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully!');
    }
}
