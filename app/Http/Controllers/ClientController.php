<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function show(Client $client)
    {
        return $client;
    }

    public function store(Request $request)
    {
        $request->validate([
            "platform_id" => "required|exists:App\Models\Platform,id",
            "identifier" => "required|unique:App\Models\Client,identifier",
            "name" => "required|string|min:4"
        ]);

        return Client::create([
            "platform_id" => $request->platform_id,
            "identifier" => $request->identifier,
            "name" => $request->name
        ]);
    }

    public function getByIdentifier(int $identifier)
    {
        return Client::where("identifier", $identifier)->first() ?? abort(404, "Not found");
    }
}
