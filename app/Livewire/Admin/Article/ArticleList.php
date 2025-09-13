<?php

namespace App\Livewire\Admin\Article;

use App\Models\Article;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleList extends Component
{
    use WithPagination;

    #[Layout('components.layouts.admin')]
    #[Title('Artikel')]

    public $title = 'Daftar Artikel';

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.article.article-list', [
            'articles' => Article::latest()->paginate(5),
        ]);
    }
}
