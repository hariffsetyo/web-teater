<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $selectedCategory = '';

    protected $queryString = [
        'search'           => ['except' => ''],
        'selectedCategory' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Article::where('status', 'published');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('judul', 'like', '%' . trim($this->search) . '%')
                  ->orWhere('konten', 'like', '%' . trim($this->search) . '%');
            });
        }

        if (!empty($this->selectedCategory)) {
            $query->where('kategori', $this->selectedCategory);
        }

        // Featured article (first published with highest views or latest)
        $featuredArticle = (empty($this->search) && empty($this->selectedCategory)) 
            ? Article::where('status', 'published')->orderBy('views', 'desc')->first() 
            : null;

        if ($featuredArticle && empty($this->search) && empty($this->selectedCategory)) {
            $query->where('id', '!=', $featuredArticle->id);
        }

        $articles = $query->latest('published_at')->paginate(6);
        $categories = Article::where('status', 'published')->whereNotNull('kategori')->distinct()->pluck('kategori');

        return view('livewire.article-list', [
            'articles'        => $articles,
            'featuredArticle' => $featuredArticle,
            'categories'      => $categories,
        ]);
    }
}