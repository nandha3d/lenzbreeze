<?php

namespace App\Livewire;

use App\Models\Inquiry;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $company = '';
    public string $subject = '';
    public string $message = '';
    public string $type = 'general';
    public bool $success = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'company' => 'nullable|string|max:255',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string|min:10',
        'type' => 'in:general,partnership,product',
    ];

    public function submit()
    {
        $this->validate();

        Inquiry::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'subject' => $this->subject,
            'message' => $this->message,
            'type' => $this->type,
        ]);

        $this->reset(['name', 'email', 'phone', 'company', 'subject', 'message']);
        $this->success = true;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
