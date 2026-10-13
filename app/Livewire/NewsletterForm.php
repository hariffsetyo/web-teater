<?php

namespace App\Livewire;

use App\Models\Newsletter;
use Livewire\Component;

class NewsletterForm extends Component
{
    public string $email = '';
    public bool $subscribed = false;

    protected $rules = [
        'email' => 'required|email|unique:newsletters,email',
    ];

    protected $messages = [
        'email.required' => 'Mohon masukkan alamat email.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email ini sudah terdaftar dalam buletin kami.',
    ];

    public function subscribe()
    {
        $this->validate();

        Newsletter::create([
            'email' => strtolower(trim($this->email)),
            'subscribed_at' => now(),
        ]);

        $this->reset('email');
        $this->subscribed = true;
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}