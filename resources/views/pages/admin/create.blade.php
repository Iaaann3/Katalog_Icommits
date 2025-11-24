@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Add New Application</h5>
                <div class="card-body">
                    <form action="{{ route('pages.admin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Aplikasi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama aplikasi">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- HIDDEN FIELD SLUG -->
                        <input type="hidden" id="slug" name="slug" value="{{ old('slug') }}">

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="Deskripsi aplikasi">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="demo_url" class="form-label">Demo URL <span class="text-danger">*</span></label>
                            <input type="url" class="form-control @error('demo_url') is-invalid @enderror" 
                                   id="demo_url" name="demo_url" value="{{ old('demo_url') }}" 
                                   placeholder="https://example.com">
                            @error('demo_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- IMAGE MAIN -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Aplikasi</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <!-- Preview Gambar -->
                            <div class="mt-3 text-center">
                                <img id="preview-image" src="#" alt="Preview Gambar" 
                                     class="img-thumbnail d-none" width="150">
                            </div>
                        </div>

                        <!-- MULTIPLE IMAGE CLIP -->
                        <div class="mb-3">
                            <label class="form-label">Image Clip (Maksimal 4 Foto)</label>
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
                                       {{ old('status') ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Status Aktif</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pages.admin.dashboard') }}" class="btn btn-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i> Simpan Aplikasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    const imageInput = document.getElementById('image');
    const previewImage = document.getElementById('preview-image');
    
    // Generate slug otomatis
    nameInput.addEventListener('input', function() {
        const slug = this.value
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
        slugInput.value = slug;
    });

    // Preview gambar utama
    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            previewImage.src = URL.createObjectURL(file);
            previewImage.classList.remove('d-none');
        } else {
            previewImage.classList.add('d-none');
        }
    });

    // Preview multiple image clip (max 5)
    const imageClipInput = document.getElementById('image_clip');
    const previewMultiple = document.getElementById('preview-multiple');

    imageClipInput.addEventListener('change', function(event) {
        previewMultiple.innerHTML = "";
        const files = Array.from(event.target.files);

        if (files.length > 5) {
            alert("Maksimal unggah 5 foto.");
            imageClipInput.value = "";
            return;
        }

        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.classList.add('col-3', 'mb-2');
                col.innerHTML = `
                    <img src="${e.target.result}" 
                         class="img-thumbnail" 
                         width="120">
                `;
                previewMultiple.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    });

});
</script>
@endsection
