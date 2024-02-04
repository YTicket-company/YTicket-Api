<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Client;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Ticket::orderBy('id', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        $ticket = Ticket::create([
            "name" => $request->name,
            "status_id" => $request->status_id,
            "client_id" => Client::where("identifier", $request->client_identifier)->first()->id,
            "channel_id" => $request->channel_id
        ]);

        return $ticket;
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return $ticket;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'name' => 'min:4',
            'status_id' => 'exists:App\Models\Status,id',
            'channel_id' => "integer"
        ]);

        $ticket->update([
            "name" => $request->name ?? $ticket->name,
            "status_id" => $request->status_id ?? $ticket->status_id,
            "channel_id" => $request->channel_id ?? $ticket->channel_id
        ]);

        return $ticket;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        return $ticket->delete();
    }

    public function getByIdentifier(int $identifier)
    {
        $client = Client::where('identifier', $identifier)->firstOrFail();

        // Récupérer tous les tickets pour ce client
        $tickets = $client->tickets;
        return $tickets ?? abort(404);
    }

    public function getOpenByIdentifier(int $identifier) {
        $ticket = Ticket::whereHas('client', function ($query) use ($identifier) {
            return $query->where('identifier', $identifier);
        })->where("status_id", 1)->first();
        return $ticket ?? abort(404, "Not found !");
    }
}
