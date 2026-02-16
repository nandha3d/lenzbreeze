<?php

namespace App\Livewire;

use App\Models\Subscriber;
use Livewire\Component;

class NewsletterForm extends Component
{
    public string $email = '';
    public bool $success = false;
    public string $errorMessage = '';

    public function subscribe()
    {
        $this->validate(['email' => 'required|email|max:255']);
        $this->errorMessage = '';

        $existing = Subscriber::where('email', $this->email)->first();

        if ($existing) {
            if ($existing->status === 'active') {
                $this->errorMessage = 'You are already subscribed!';
                return;
            }
            $existing->update(['status' => 'active', 'subscribed_at' => now()]);
        } else {
            Subscriber::create(['email' => $this->email, 'subscribed_at' => now()]);
        }

        $this->reset('email');
        $this->success = true;
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
