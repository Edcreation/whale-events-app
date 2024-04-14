<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'available' => 'required|integer',
        ]);

        // Create a new ticket
        $ticket = Ticket::create($request->all());

        return response()->json($ticket, 201);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'available' => 'required|integer',
        ]);

        // Find the ticket by ID
        $ticket = Ticket::findOrFail($id);

        // Update the ticket
        $ticket->update($request->all());

        return response()->json($ticket);
    }

    public function destroy($id)
    {
        // Find the ticket by ID
        $ticket = Ticket::findOrFail($id);

        // Delete the ticket
        $ticket->delete();

        return response()->json(['message' => 'Ticket deleted']);
    }
}
