<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class ArticleComments extends Component
{
    public int $articleId;
    public string $nama_guest = '';
    public string $email_guest = '';
    public string $isi = '';
    public string $trap = ''; // honeypot
    public bool $submitted = false;

    protected $rules = [
        'nama_guest'  => 'required|min:3|max:100',
        'email_guest' => 'required|email|max:100',
        'isi'         => 'required|min:5|max:1000',
    ];

    protected $messages = [
        'nama_guest.required'  => 'Nama lengkap wajib diisi.',
        'email_guest.required' => 'Email wajib diisi.',
        'email_guest.email'    => 'Format email tidak valid.',
        'isi.required'         => 'Komentar tidak boleh kosong.',
        'isi.min'              => 'Komentar minimal 5 karakter.',
    ];

    public function submitComment()
    {
        // Honeypot check
        if (!empty($this->trap)) {
            return;
        }

        $this->validate();

        Comment::create([
            'article_id'  => $this->articleId,
            'nama_guest'  => strip_tags(trim($this->nama_guest)),
            'email_guest' => strtolower(trim($this->email_guest)),
            'isi'         => strip_tags(trim($this->isi)),
            'status'      => 'pending', // menunggu approval admin
        ]);

        $this->reset(['nama_guest', 'email_guest', 'isi']);
        $this->submitted = true;
    }

    public function render()
    {
        $approvedComments = Comment::where('article_id', $this->articleId)
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('livewire.article-comments', [
            'comments' => $approvedComments,
        ]);
    }
}