<?php

namespace App\Livewire\Admin\Gallery;

use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class GalleryCreate extends Component
{
    use WithFileUploads;
    #[Layout('components.layouts.admin')]
    #[Title('Buat Galeri')]

    public $title = 'Buat Galeri';

    public $gallery_image = [];

    public function removeImage($index)
    {
        if (isset($this->gallery_image[$index])) {
            unset($this->gallery_image[$index]);
            $this->gallery_image = array_values($this->gallery_image); // reset index agar rapi
        }
    }

    public function store()
    {
        foreach ($this->gallery_image as $image) {
            $name = 'gallery_' . round(microtime(true) * 1000);
            $path = $image->store('/galleries', 'public');
            // delete temporary file
            if ($image instanceof TemporaryUploadedFile) {
                $image->delete();
            }
            if ($path) {
                Gallery::create([
                    'gallery_name' => $name,
                    'gallery_image' => $path,
                ]);
            }
        }

        session()->flash('success', "Gambar di galeri berhasil ditambahkan");
        return $this->redirectRoute('gallery.list', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.gallery.gallery-create');
    }
}
