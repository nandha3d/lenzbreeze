<?php

namespace App\Http\Requests;

use App\Models\Warranty;
use Illuminate\Foundation\Http\FormRequest;

class StoreWarrantyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Product
            'product_name'       => 'required|string|max:255',
            'serial_number'      => 'nullable|string|max:30|unique:warranties,serial_number',

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

            // Notes
            'notes'              => 'nullable|string|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'serial_number.unique'      => 'This serial number is already registered.',
            'customer_phone.required'   => 'Customer phone number is required.',
            'customer_address.required' => 'Customer address is required.',
            'retailer_id.required'      => 'Please select a retailer.',
            'retailer_id.exists'        => 'Selected retailer does not exist.',
            'lens_type.required'        => 'Please select a lens type.',
            'lens_coating.required'     => 'Please select a lens coating.',
            'warranty_months.required'  => 'Please select warranty duration.',
            'warranty_months.in'        => 'Warranty duration must be 6, 12, or 24 months.',
            'customer_photo.image'      => 'Customer photo must be an image file.',
            'customer_photo.max'        => 'Customer photo must be under 2MB.',
        ];
    }
}
