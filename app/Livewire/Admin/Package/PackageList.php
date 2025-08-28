<?php

namespace App\Livewire\Admin\Package;

use App\Models\Package;
use Livewire\Attributes\Title;
use Livewire\Component;

class PackageList extends Component
{
    #[Title('Paket Trip')]
    public $title = 'Paket Trip';
    public function render()
    {
        return view('livewire.admin.package.package-list', [
            'packages' => Package::latest()->get()
        ])->layout('components.layouts.admin');
    }
}
