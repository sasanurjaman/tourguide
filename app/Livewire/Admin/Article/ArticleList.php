<?php

namespace App\Livewire\Admin\Article;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
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

    public $search;
    public $perpage = 5;

    public function updatingSearch()
    {
        // reset halaman kalau search berubah
        $this->resetPage();
    }

    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();

        if ($article->article_image) {
            if (Storage::exists($article->article_image)) {
                Storage::delete($article->article_image);
            }
        }

        session()->flash('success', "Artikel $article->article_title berhasil dihapus");
        return $this->redirectRoute('article.list', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.article.article-list', [
            'articles' => Article::where('article_title', 'like', '%' . $this->search . '%')
                ->orWhere('article_description', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate($this->perpage),
        ]);
    }
}
