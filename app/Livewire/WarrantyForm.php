<?php

namespace App\Livewire;

use App\Models\Inquiry;
use Livewire\Component;

class WarrantyForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $product_name = '';
    public string $purchase_date = '';
    public string $retailer_name = '';
    public string $invoice_number = '';
    public string $issue_description = '';
    public bool $success = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'product_name' => 'required|string|max:255',
        'purchase_date' => 'required|date',
        'retailer_name' => 'required|string|max:255',
        'invoice_number' => 'nullable|string|max:100',
        'issue_description' => 'required|string|min:10',
    ];

    protected $messages = [
        'name.required' => 'Please enter your full name.',
        'email.required' => 'We need your email to send updates.',
        'phone.required' => 'Phone number is required for quick follow-up.',
        'product_name.required' => 'Please tell us which lens product you purchased.',
        'purchase_date.required' => 'Purchase date helps us verify warranty coverage.',
        'retailer_name.required' => 'Please enter the shop/retailer name.',
        'issue_description.required' => 'Please describe the issue you\'re experiencing.',
        'issue_description.min' => 'Please provide at least 10 characters to describe the issue.',
    ];

    public function submit()
    {
        $this->validate();

        Inquiry::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->retailer_name,
            'subject' => 'Warranty Claim — ' . $this->product_name,
            'message' => "Product: {$this->product_name}\n"
                       . "Purchase Date: {$this->purchase_date}\n"
                       . "Retailer: {$this->retailer_name}\n"
                       . "Invoice #: {$this->invoice_number}\n\n"
                       . "Issue:\n{$this->issue_description}",
            'type' => 'warranty',
        ]);

        $this->reset(['name', 'email', 'phone', 'product_name', 'purchase_date', 'retailer_name', 'invoice_number', 'issue_description']);
        $this->success = true;
    }

    public function render()
    {
        return view('livewire.warranty-form');
    }
}
