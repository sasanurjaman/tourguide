<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a wire:navigate href="{{ route('gallery.list') }}">Galleri</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>

                    <div>
                        <div class="container mx-auto p-6">
                            <h2 class="text-2xl font-bold mb-6 text-gray-800">Upload Gallery Images</h2>

                            <!-- Success Message -->
                            @if(session()->has('message'))
                            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                                {{ session('message') }}
                            </div>
                            @endif

                            <form wire:submit.prevent="store" class="g-3 needs-validation" novalidate>
                                @csrf
                                <div>
                                    <div ondragover="event.preventDefault();" ondrop="handleDrop(event);"
                                        style="cursor: pointer;"
                                        class="border p-4 text-center bg-light border-2 border-secondary border-opacity-25 rounded">
                                        <p>Drag and drop your image here</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0z" />
                                        </svg>
                                        <input wire:model="gallery_image" class="d-none" multiple id="gallery_image"
                                            type="file" accept="image/*">
                                    </div>
                                    @error('gallery_image')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    {{-- Progress Bar Upload --}}
                                    <div class="mt-3" wire:loading wire:target="gallery_image">
                                        <div class="progress" style="height: 25px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                                                role="progressbar" style="width: 100%">
                                                Mengunggah gambar...
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Preview Image --}}
                                    <div class="mt-3 d-flex flex-wrap gap-2">
                                        @if ($gallery_image)
                                        @foreach ($gallery_image as $index => $img)
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ $img->temporaryUrl() }}" class="img-thumbnail" width="100">
                                            <button type="button" wire:click="removeImage({{ $index }})"
                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 translate-middle p-1 rounded-circle"
                                                style="width: 20px; height: 20px; line-height: 0;">
                                                &times;
                                            </button>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>

                                </div>

                                <button class="btn btn-primary">Simpan</button>
                            </form><!-- End Custom Styled Validation -->

                        </div>

                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    @push('script')
    <script>
        function handleDrop(event) {
            event.preventDefault();
            const files = event.dataTransfer.files;
            if (files.length > 0) {
                const fileInput = document.getElementById('gallery_image');
                fileInput.files = files;
                const event = new Event('change', { bubbles: true });
                fileInput.dispatchEvent(event);
            }
        }
        document.querySelector('.border').addEventListener('click', function() {
            document.getElementById('gallery_image').click();
        });
    </script>
    @endpush
</div>