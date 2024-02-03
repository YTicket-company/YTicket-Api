<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Client;
use App\Models\Ticket;

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
    public function update(TicketRequest $request, Ticket $ticket)
    {
        $ticket->update([
            "name" => $request->name,
            "status_id" => $request->status_id,
            "client_id" => Client::where("identifier", $request->client_identifier)->first()->id,
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
}
