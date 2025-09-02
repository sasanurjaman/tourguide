<?php

namespace App\Livewire\Admin\Package;

use App\Models\Package;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class PackageList extends Component
{
    use WithPagination;

    #[Title('Paket Trip')]
    public $title = 'Paket Trip';

    public $search;
    public $perpage = 5;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        // reset halaman kalau search berubah
        $this->resetPage();
    }

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
            'packages' => Package::where('package_name', 'like', "%{$this->search}%")
                ->orWhere('package_description', 'like', "%{$this->search}%")
                ->orWhere('package_price', 'like', "%{$this->search}%")
                ->latest()
                ->paginate((int) $this->perpage)
        ]);
    }
}
