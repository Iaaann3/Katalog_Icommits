@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Tables /</span> Applications
    </h4>
    <a href="{{ route('pages.admin.create') }}" class="btn btn-primary">
      <i class="bx bx-plus me-1"></i> Add Application
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Applications List</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Aplikasi</th>
            <th>Slug</th>
            <th>Deskripsi</th>
            <th>Demo</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse ($applications as $app)
            <tr>
              <td><strong>{{ $loop->iteration }}</strong></td>
              <td>
                <div class="d-flex align-items-center">
                  @if($app->image)
                    {{-- ✅ Perbaikan utama: langsung gunakan asset($app->image) --}}
                    <img src="{{ asset($app->image) }}" 
                         alt="{{ $app->name }}" 
                         class="rounded-circle me-3" 
                         width="40" height="40"
                         onerror="this.src='{{ asset('assets/img/placeholder-avatar.png') }}'">
                  @else
                    <i class="fab fa-laravel fa-lg text-danger me-3"></i>
                  @endif
                  <strong>{{ $app->name }}</strong>
                </div>
              </td>
              <td>{{ $app->slug }}</td>
              <td>{{ Str::limit($app->description, 50) }}</td>
              <td>
                <a href="{{ $app->demo_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                  <i class="bx bx-link-external me-1"></i> Demo
                </a>
              </td>
              <td>
                @if($app->status)
                  <span class="badge bg-label-success me-1">Aktif</span>
                @else
                  <span class="badge bg-label-danger me-1">Nonaktif</span>
                @endif
              </td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('pages.admin.edit', $app->id) }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                    <form action="{{ route('pages.admin.destroy', $app->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Yakin hapus aplikasi ini?')">
                        <i class="bx bx-trash me-1"></i> Delete
                      </button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center py-4">
                <div class="text-muted">No applications found.</div>
                <a href="{{ route('pages.admin.create') }}" class="btn btn-primary mt-2">
                  <i class="bx bx-plus me-1"></i> Add First Application
                </a>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection