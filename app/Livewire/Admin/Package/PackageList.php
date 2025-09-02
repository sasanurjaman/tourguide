<?php

namespace App\Livewire\Admin\Package;

use App\Models\Package;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class PackageList extends Component
{
    #[Title('Paket Trip')]
    public $title = 'Paket Trip';

    public function delete($id)
    {
        $package = Package::find($id);
        if ($package->package_image) {
            if (Storage::exists($package->package_image)) {
                Storage::delete($package->package_image);
            }
        }
        $package->delete();

        session()->flash('success', "Paket $package->package_name berhasil dihapus");
        return $this->redirectRoute('package-list', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.package.package-list', [
            'packages' => Package::latest()->get()
        ]);
    }
}
