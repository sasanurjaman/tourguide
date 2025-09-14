<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a wire:navigate href="{{ route('article.list') }}">Artikel</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>

                    <!-- Custom Styled Validation -->
                    <form wire:submit.prevent="store" class="g-3 needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div>
                                    <label for="article_title" class="form-label">Judul Artikel</label>
                                    <input wire:model="article_title" type="text"
                                        class="form-control @error('article_title') is-invalid @enderror"
                                        id="article_title" value="{{ old('article_title') }}">
                                    @error('article_title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <label for="article_image" class="form-label">Gambar Artikel</label>
                                    <input wire:model="article_image"
                                        class="form-control @error('article_image') is-invalid @enderror"
                                        id="article_image" type="file" accept="image/*">

                                    @error('article_image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- Progress Bar Upload --}}
                                <div class="mt-3" wire:loading wire:target="article_image">
                                    <div class="progress" style="height: 25px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                                            role="progressbar" style="width: 100%">
                                            Mengunggah gambar...
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <img src="{{ $article_image ? $article_image->temporaryUrl() : '' }}" alt=""
                                        id="preview" class="img-fluid" width="150px">
                                </div>
                            </div>
                        </div>

                        @error('article_description')
                        <p class="text-danger mt-2">
                            {{ $message }}
                        </p>
                        @enderror
                        <div wire:ignore class="mb-3">
                            <label for="editor" class="form-label">Deskripsi Artikel</label>
                            <div id="editor"></div>
                        </div>

                        <button class="btn btn-primary mt-2">Simpan</button>
                    </form>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    @push('script')
    <script>
        const toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'], // toggled buttons
        
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }], // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }], // outdent/indent
        
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        
        [{ 'color': [] }, { 'background': [] }], // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],
        
        ['clean'] // remove formatting button
        ];
        // Initialize Quill editor
        var quill = new Quill('#editor', {
            modules: {
            toolbar: toolbarOptions
            },
            theme: 'snow',
            placeholder: 'Tulis deskripsi artikel di sini...'
        });
        quill.on('text-change', function() {
            @this.set('article_description', quill.root.innerHTML);
        });
    </script>
    @endpush
</div>