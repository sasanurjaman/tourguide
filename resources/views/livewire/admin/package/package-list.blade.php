<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                @if (session()->has('success'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card-body row">
                    <div class="col-sm-6">
                        <h5 class="card-title">Daftar Paket</h5>
                    </div>
                    <div class="col-sm-6 align-content-center justify-content-center">
                        <a wire:navigate href="{{ route('package.create') }}" class="btn btn-primary float-end"><i
                                class="bi bi-plus-circle"></i> Tambah Paket</a>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <input type="text" wire:model.live.debounce.100ms="search" class="form-control w-50"
                            placeholder="Cari paket...">

                        <select wire:model.live="perpage" class="form-select w-auto">
                            <option value="5">5 / halaman</option>
                            <option value="10">10 / halaman</option>
                            <option value="20">20 / halaman</option>
                            <option value="50">50 / halaman</option>
                        </select>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Paket</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Harga (Rp)</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $package->package_name }}</td>
                                    <td>{{ $package->package_description }}</td>
                                    <td class="text-end">{{ number_format($package->package_price, 0, ',', '.') }}</td>
                                    <td>
                                        <a wire:navigate href="{{ route('package.edit', $package->id) }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                            class="badge bg-warning"><i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button wire:click="delete({{ $package->id }})"
                                            wire:confirm="Anda yakin ingin menghapus paket {{ $package->package_name }}?"
                                            class="badge bg-danger border-0"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $packages->links() }}
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
</div>