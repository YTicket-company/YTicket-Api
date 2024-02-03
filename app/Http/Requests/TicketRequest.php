<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:4',
            'status_id' => 'required|exists:App\Models\Status,id',
            'client_identifier' => 'required|exists:App\Models\Client,identifier',
            'channel_id' => "integer|required"
        ];
    }
}
