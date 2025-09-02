<?php

namespace App\Livewire\Admin\Package;

use App\Http\Requests\PackageRequest;
use App\Models\Package;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class PackageEdit extends Component
{
    use WithFileUploads;

    #[Layout('components.layouts.admin')]
    #[Title('Edit Paket')]

    public $title = 'Edit Paket';
    public $package;
    public $package_name, $package_description, $package_price;
    public $package_image;
    public $package_imageold;

    public function mount($id)
    {
        $this->package = Package::find($id);
        $this->package_name = $this->package->package_name;
        $this->package_description = $this->package->package_description;
        $this->package_price = $this->package->package_price;
        $this->package_imageold = $this->package->package_image;
    }

    public function update()
    {
        // Validasi input
        $request = new PackageRequest();
        $request->id = $this->package->id;

        $data = $this->validate($request->rules());

        if ($this->package_image) {
            if ($this->package_imageold) {
                if (Storage::exists($this->package_imageold)) {
                    Storage::delete($this->package_imageold);
                }
            }
            $data['package_image'] = $this->package_image->store('packages', 'public');
        }

        if ($this->package_image instanceof TemporaryUploadedFile) {
            $this->package_image->delete();
        }

        $this->package->update($data);

        session()->flash('message', 'Paket berhasil diperbarui.');
        return $this->redirectRoute('package-list', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.package.package-edit');
    }
}
