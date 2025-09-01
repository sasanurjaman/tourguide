<?php

namespace App\Livewire\Admin\Package;

use App\Models\Package;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class PackageCreate extends Component
{
    use WithFileUploads;

    #[Layout('components.layouts.admin')]
    #[Title('Tambah Paket Trip')]
    public $title = 'Tambah Paket Trip';

    public $package_name, $package_description, $package_price;
    public $package_image;

    public $rules = [
        'package_name' => 'required|string|max:255|unique:packages',
        'package_description' => 'required|string',
        'package_price' => 'required|numeric|min:0',
        'package_image' => 'nullable|image|max:2048', // Maksimal 2MB
    ];

    public function store()
    {
        $data = $this->validate();

        if ($this->package_image) {
            $data['package_image'] = $this->package_image->store('packages', 'public');
        }

        // dd($data);

        Package::create($data);

        if ($this->package_image instanceof TemporaryUploadedFile) {
            $this->package_image->delete();
        }
        session()->flash('success', 'Paket berhasil ditambahkan');
        return $this->redirectRoute('package-list', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.package.package-create');
    }
}
