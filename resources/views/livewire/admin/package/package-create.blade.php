<div>
    {{-- Success is as dangerous as failure. --}}
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title }} </h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a wire:navigate href="{{ route('package-list') }}">Paket Trip</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Paket</h5>

                    <!-- Custom Styled Validation -->
                    <form wire:submit.prevent="store" class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="col-md-6">
                            <!-- package_name -->
                            <div>
                                <label for="package_name" class="form-label">Nama Paket</label>
                                <input wire:model="package_name" type="text"
                                    class="form-control @error('package_name') is-invalid @enderror" id="package_name"
                                    value="{{ old('package_name') }}">
                                @error('package_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- package_price -->
                            <div>
                                <label for="package_price" class="form-label">Harga Paket</label>
                                <input wire:model="package_price" type="text"
                                    class="form-control @error('package_price') is-invalid @enderror" id="package_price"
                                    value="{{ old('package_price') }}">
                                @error('package_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div>
                                <label for="package_description" class="form-label">Deskripsi Paket</label>
                                <textarea wire:model="package_description" id="package_description"
                                    class="form-control @error('package_description') is-invalid @enderror"
                                    style="height: 100px"></textarea>
                                @error('package_description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div>
                                <label for="package_image" class="form-label">Gambar Paket</label>
                                <input wire:model="package_image"
                                    class="form-control @error('package_image') is-invalid @enderror" id="package_image"
                                    type="file" accept="image/*">
                                @error('package_image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            {{-- Progress Bar Upload --}}
                            <div class="mt-3" wire:loading wire:target="package_image">
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                                        role="progressbar" style="width: 100%">
                                        Mengunggah gambar...
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <img src="{{ $package_image ? $package_image->temporaryUrl() : '' }}" alt=""
                                    id="preview" class="img-fluid" width="150px">
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form><!-- End Custom Styled Validation -->

                </div>
            </div>
        </section>

    </main><!-- End #main -->
</div>