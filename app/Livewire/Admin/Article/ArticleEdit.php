<?php

namespace App\Livewire\Admin\Article;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ArticleEdit extends Component
{
    use WithFileUploads;
    #[Layout('components.layouts.admin')]
    #[Title('Edit Artikel')]

    public $title = 'Edit Artikel';

    public $article;
    public $article_title;
    public $article_slug;
    public $article_description;
    public $article_image;
    public $article_imageOld;

    public function mount($id)
    {
        $this->article = Article::find($id);
        $this->article_title = $this->article->article_title;
        $this->article_slug = $this->article->article_slug;
        $this->article_imageOld = $this->article->article_image;
        $this->article_description = $this->article->article_description;
    }

    public function update()
    {
        $request = new ArticleRequest();
        $request->id = $this->article->id;
        $data = $this->validate($request->rules());

        if ($this->article_image) {
            if ($this->article_imageOld) {
                if (Storage::exists($this->article_imageOld)) {
                    Storage::delete($this->article_imageOld);
                }
            }
            $data['article_image'] = $this->article_image->store('article', 'public');
        }

        if ($this->article_image instanceof TemporaryUploadedFile) {
            $this->article_image->delete();
        }

        $this->article->update($data);

        session()->flash('success', 'Artikel berhasil diperbarui.');
        return $this->redirectRoute('article.list', navigate: true);
    }
    public function render()
    {
        return view('livewire.admin.article.article-edit');
    }
}
