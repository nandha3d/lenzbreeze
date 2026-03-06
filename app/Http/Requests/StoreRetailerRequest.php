<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRetailerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
            'address'    => 'required|string|max:1000',
            'city'       => 'required|string|max:100',
            'state'      => 'required|string|max:100',
            'is_active'  => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'Retailer / shop name is required.',
            'owner_name.required' => 'Owner or contact person name is required.',
            'phone.required'      => 'Contact phone number is required.',
            'address.required'    => 'Street address is required.',
            'city.required'       => 'City is required.',
            'state.required'      => 'State is required.',
        ];
    }
}
