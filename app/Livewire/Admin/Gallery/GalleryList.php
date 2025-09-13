<?php

namespace App\Livewire\Admin\Gallery;

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class GalleryList extends Component
{
    use WithFileUploads;
    use WithPagination;

    #[Layout('components.layouts.admin')]
    #[Title('Galeri')]

    protected $paginationTheme = 'bootstrap';

    public $title = 'Galeri';

    public function delete($id)
    {
        $gallery = Gallery::find($id);
        if ($gallery->gallery_image) {
            if (Storage::exists($gallery->gallery_image)) {
                Storage::delete($gallery->gallery_image);
            }
        }
        $gallery->delete();

        session()->flash('success', "Gambar di galeri berhasil dihapus");
        return $this->redirectRoute('gallery.list', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.gallery.gallery-list', [
            'galleries' => Gallery::latest()->paginate(5)
        ]);
    }
}
