<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
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
                    {{-- <div class="col-sm-6 align-content-center justify-content-center">
                        <a wire:navigate href="{{ route('package.create') }}" class="btn btn-primary float-end"><i
                                class="bi bi-plus-circle"></i> Tambah Paket</a>
                    </div> --}}
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
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">judul</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $article->article_title }}</td>
                                    <td>{{ $article->article_description }}</td>
                                    {{-- <td>
                                        <a wire:navigate href="{{ route('article.edit', $article->id) }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                            class="badge bg-warning"><i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button wire:click="delete({{ $article->id }})"
                                            wire:confirm="Anda yakin ingin menghapus paket {{ $article->article_name }}?"
                                            class="badge bg-danger border-0"><i class="bi bi-trash"></i></button>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
</div>