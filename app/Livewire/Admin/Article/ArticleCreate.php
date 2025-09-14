<?php

namespace App\Livewire\Admin\Article;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ArticleCreate extends Component
{
    use WithFileUploads;

    #[Layout('components.layouts.admin')]
    #[Title('Buat Artikel')]

    public $title = 'Buat Artikel';

    public $article_title;
    public $article_slug;
    public $article_description;
    public $article_image;

    public function store()
    {
        $this->article_slug = Str::slug($this->article_title, '_');
        $data = $this->validate((new ArticleRequest())->rules());

        if ($this->article_image) {
            $data['article_image'] = $this->article_image->store('article', 'public');
        }

        Article::create($data);

        if ($this->article_image instanceof TemporaryUploadedFile) {
            $this->article_image->delete();
        }

        session()->flash('success', 'artikel berhasil ditambahkan');
        return $this->redirectRoute('article.list', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.article.article-create');
    }
}
