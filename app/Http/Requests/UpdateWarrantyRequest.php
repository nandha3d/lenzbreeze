<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWarrantyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $warrantyId = $this->route('warranty')?->id;

        return [
            'product_name'       => 'required|string|max:255',

            // Customer
            'customer_name'      => 'required|string|max:255',
            'customer_phone'     => 'required|string|max:20',
            'customer_email'     => 'nullable|email|max:255',
            'customer_address'   => 'required|string|max:1000',
            'customer_photo'     => 'nullable|image|max:2048',

            // Eye Power
            'right_eye_sph'      => 'nullable|numeric|between:-20,20',
            'right_eye_cyl'      => 'nullable|numeric|between:-10,10',
            'right_eye_axis'     => 'nullable|integer|between:0,180',
            'right_eye_add'      => 'nullable|numeric|between:0,5',
            'left_eye_sph'       => 'nullable|numeric|between:-20,20',
            'left_eye_cyl'       => 'nullable|numeric|between:-10,10',
            'left_eye_axis'      => 'nullable|integer|between:0,180',
            'left_eye_add'       => 'nullable|numeric|between:0,5',
            'pupillary_distance' => 'nullable|numeric|between:45,80',

            // Lens
            'lens_type'          => 'required|string|max:100',
            'lens_coating'       => 'required|string|max:100',
            'lens_index'         => 'nullable|string|max:10',
            'manufacturing_date' => 'nullable|date|before_or_equal:today',
            'batch_number'       => 'nullable|string|max:50',

            // Sale
            'retailer_id'        => 'required|exists:retailers,id',
            'purchase_date'      => 'required|date',
            'warranty_months'    => 'required|in:6,12,24',

            // Status & Claims
            'status'             => 'required|in:active,expired,under_claim,approved,rejected,resolved,void',
            'claim_notes'        => 'nullable|string|max:5000',
            'notes'              => 'nullable|string|max:2000',
        ];
    }
}
