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
                        <h5 class="card-title">{{ $title }}</h5>
                    </div>
                    <div class="col-sm-6 align-content-center justify-content-center">
                        <a wire:navigate href="{{ route('gallery.create') }}" data-bs-toggle="modal"
                            data-bs-target="#create_modal" class="btn btn-primary float-end"><i
                                class="bi bi-plus-circle"></i>
                            Tambah Galeri</a>
                    </div>
                    {{-- <div class="d-flex justify-content-between mb-3">
                        <input type="text" wire:model.live.debounce.100ms="search" class="form-control w-50"
                            placeholder="Cari paket...">

                        <select wire:model.live="perpage" class="form-select w-auto">
                            <option value="5">5 / halaman</option>
                            <option value="10">10 / halaman</option>
                            <option value="20">20 / halaman</option>
                            <option value="50">50 / halaman</option>
                        </select>
                    </div> --}}
                    {{-- <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Galleri</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($galleries as $gallery)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $gallery->gallery_name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $gallery->gallery_image) }}"
                                            alt="{{ $gallery->gallery_name }}" class="img-fluid" width="80px">
                                    </td>
                                    <td>
                                        <button data-bs-toggle="modal" data-bs-target="#edit_modal"
                                            class="badge bg-warning border-0"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <button wire:click="delete({{ $gallery->id }})"
                                            wire:confirm="Anda yakin ingin menghapus paket {{ $gallery->gallery_name }}?"
                                            class="badge bg-danger border-0"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $galleries->links() }}
                    </div> --}}
                    <div class="row g-3">
                        @forelse ($galleries as $gallery)
                        <div class="col-6 col-md-3">
                            <div class="card shadow-sm h-100">
                                <img src="{{ asset('storage/'.$gallery->gallery_image) }}" class="card-img-top"
                                    alt="{{ $gallery->gallery_name }}" style="object-fit: cover; height: 150px;">

                                <div class="card-body text-center">
                                    <h6 class="card-title text-truncate">{{ $gallery->gallery_name }}</h6>
                                </div>

                                <div class="card-footer d-flex justify-content-center gap-2">
                                    <a href="{{ asset('storage/'.$gallery->gallery_image) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        Lihat
                                    </a>
                                    <button wire:click="delete({{ $gallery->id }})"
                                        class="btn btn-sm btn-outline-danger"
                                        wire:confirm="Anda yakin ingin menghapus paket {{ $gallery->gallery_name }}?">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada gambar di galeri.</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $galleries->links() }}
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

</div>