@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Edit Application</h5>
                <div class="card-body">
                    <form action="{{ route('pages.admin.update', $application->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- NAMA APLIKASI -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Aplikasi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $application->name) }}" placeholder="Masukkan nama aplikasi">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- SLUG -->
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                   id="slug" name="slug" value="{{ old('slug', $application->slug) }}" placeholder="slug-aplikasi">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Slug akan digenerate otomatis dari nama aplikasi.</div>
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="3"
                                      placeholder="Deskripsi aplikasi">{{ old('description', $application->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- DEMO URL -->
                        <div class="mb-3">
                            <label for="demo_url" class="form-label">Demo URL <span class="text-danger">*</span></label>
                            <input type="url" class="form-control @error('demo_url') is-invalid @enderror"
                                   id="demo_url" name="demo_url" value="{{ old('demo_url', $application->demo_url) }}"
                                   placeholder="https://example.com">
                            @error('demo_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- GAMBAR UTAMA -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Aplikasi</label>
                            @if($application->image)
                                <div class="mb-2">
                                    <img src="{{ asset($application->image) }}" alt="{{ $application->name }}" class="img-thumbnail" width="100">
                                    <div class="form-text">Gambar saat ini.</div>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- IMAGE CLIP 5 FOTO -->
                        <div class="mb-3">
                            <label class="form-label">Image Clip (Max 5 Foto)</label>

                            <!-- Foto lama -->
                            @if(is_array($application->image_clip))
                                <div class="row mb-2">
                                    @foreach($application->image_clip as $img)
                                        <div class="col-2 text-center">
                                            <img src="{{ asset($img) }}" class="img-thumbnail mb-1" width="100">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-text mb-2">Foto clip saat ini.</div>
                            @endif

                            <input 
                                type="file" 
                                class="form-control @error('image_clip') is-invalid @enderror @error('image_clip.*') is-invalid @enderror"
                                id="image_clip" 
                                name="image_clip[]" 
                                accept="image/*" 
                                multiple
                            >
                            @error('image_clip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('image_clip.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="row mt-3" id="preview-multiple"></div>
                        </div>

                        <!-- STATUS -->
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                                       {{ old('status', $application->status) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Status Aktif</label>
                            </div>
                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pages.admin.dashboard') }}" class="btn btn-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i> Update Aplikasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT: AUTO SLUG + PREVIEW MULTIPLE -->
<script>
document.addEventListener('DOMContentLoaded', function() {

    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    function generateSlug(text) {
        return text.toLowerCase().trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    let manual = false;
    slugInput.addEventListener('input', () => manual = true);
    nameInput.addEventListener('input', function() {
        if (!manual) {
            slugInput.value = generateSlug(this.value);
        }
    });

    // Preview Multiple Image Clip
    const imageClip = document.getElementById('image_clip');
    const preview = document.getElementById('preview-multiple');

    imageClip.addEventListener('change', function(e) {
        preview.innerHTML = "";
        const files = Array.from(e.target.files);

        if (files.length > 5) {
            alert("Maksimal upload 5 foto.");
            imageClip.value = "";
            return;
        }

        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(evt) {
                const col = document.createElement('div');
                col.classList.add('col-3', 'mb-2');
                col.innerHTML = `<img src="${evt.target.result}" class="img-thumbnail" width="120">`;
                preview.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    });

});
</script>
@endsection
