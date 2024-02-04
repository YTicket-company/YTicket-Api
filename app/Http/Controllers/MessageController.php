<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "ticket_id" => "required|exists:App\Models\Ticket,id",
            "client_id" => "required_without:user_id|exists:App\Models\Client,id",
            "user_id" => "required_without:client_id|exists:App\Models\User,id",
            "message" => "required"
        ]);

        $message = Message::create([
            "ticket_id" => $request->ticket_id,
            "client_id" => $request->client_id,
            "user_id" => $request->user_id,
            "message" => $request->message,
        ]);

        return Ticket::find($request->ticket_id);
    }
}
