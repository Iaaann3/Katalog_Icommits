@extends('layouts.view')

@section('title', $application->name . ' - Demo Application')

@push('styles')
<style>
    .detail-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .detail-header {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 40px;
        margin-bottom: 40px;
    }

    .detail-main {
        flex: 1;
    }

    .detail-title {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #111827;
    }

    .rating-section {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 25px;
    }

    .stars {
        display: flex;
        gap: 3px;
    }

    .star {
        color: #fbbf24;
        font-size: 18px;
    }

    .star.empty {
        color: #e5e7eb;
    }

    .reviews-count {
        color: #10b981;
        font-size: 14px;
        font-weight: 500;
    }

    .preview-section {
        position: relative;
        background: #f3f4f6;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .preview-image {
        width: 100%;
        height: 600px;
        object-fit: cover;
        display: block;
    }

    .preview-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .preview-section:hover .preview-overlay {
        opacity: 1;
    }

    .btn-preview {
        padding: 14px 28px;
        background: white;
        color: #111;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .btn-preview:hover {
        transform: scale(1.05);
    }

    .tabs-section {
        border-bottom: 2px solid #e5e7eb;
        margin-bottom: 30px;
    }

    .tabs {
        display: flex;
        gap: 30px;
        list-style: none;
    }

    .tab {
        padding: 15px 0;
        color: #6b7280;
        font-weight: 500;
        cursor: pointer;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
        transition: all 0.3s;
    }

    .tab.active {
        color: #111;
        border-bottom-color: #2563eb;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .description-text {
        color: #4b5563;
        line-height: 1.8;
        font-size: 16px;
    }

    /* Sidebar - Fix sticky */
    .detail-sidebar {
        position: sticky;
        top: 20px; /* Lebih realistis saat scroll */
        height: fit-content;
        align-self: flex-start; /* Penting untuk grid */
    }

    .sidebar-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 25px;
    }

    .sidebar-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #111;
    }

    /* Hanya tombol Live Preview */
    .btn-live-preview {
        width: 100%;
        padding: 14px;
        background: #2563eb;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-live-preview:hover {
        background: #1d4ed8;
        color: white;
    }

    .features-list {
        list-style: none;
        margin-top: 25px;
        margin-bottom: 20px;
    }

    .features-list li {
        padding: 8px 0;
        color: #4b5563;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
    }

    .check-icon {
        color: #10b981;
        flex-shrink: 0;
    }

    .stats-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #6b7280;
        font-size: 15px;
        margin-top: 20px;
    }

    .license-link {
        color: #2563eb;
        text-decoration: none;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .license-link:hover {
        text-decoration: underline;
    }

    @media (max-width: 968px) {
        .detail-header {
            grid-template-columns: 1fr;
        }

        .detail-sidebar {
            position: static;
            margin-top: 30px;
        }
    }
</style>
@endpush

@section('content')
<div class="detail-container">
    <div class="detail-header">
        <!-- Main Content -->
        <div class="detail-main">
            <h1 class="detail-title">{{ $application->name }}</h1>

            <div class="rating-section">
                <div class="stars">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star empty">★</span>
                </div>
                <span class="reviews-count">0 customers reviews</span>
            </div>

            <!-- Preview Section -->
            <div class="preview-section">
                @if($application->image)
                    <img src="{{ asset($application->image) }}" alt="{{ $application->name }}" class="preview-image">
                @else
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1200&h=600&fit=crop" alt="{{ $application->name }}" class="preview-image">
                @endif

                <div class="preview-overlay">
                    <button class="btn-preview" onclick="window.open('{{ $application->demo_url }}', '_blank')">
                        Launch Live Preview
                    </button>
                </div>
            </div>

            <!-- Tabs -->
            <div class="tabs-section">
                <ul class="tabs">
                    <li class="tab active" data-tab="description">Description</li>
                    <li class="tab" data-tab="reviews">Reviews (0)</li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="tab-content active" id="description">
                <div class="description-text">
                    <p>{{ $application->description }}</p>
                </div>
            </div>

            <div class="tab-content" id="reviews">
                <div class="description-text">
                    <p>Belum ada review untuk aplikasi ini.</p>
                </div>
            </div>
        </div>

        <!-- Sidebar - Hanya Live Preview -->
        <div class="detail-sidebar">
            <div class="sidebar-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h3 class="sidebar-title" style="margin: 0;">Demo Application</h3>
                    <a href="#" class="license-link">
                        License 
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                </div>

                <!-- Hanya Live Preview, tidak ada Download -->
                <a href="{{ $application->demo_url }}" class="btn-live-preview" target="_blank">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                    Live Preview
                </a>

                <ul class="features-list">
                    <li>
                        <svg class="check-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        Interactive demo
                    </li>
                    <li>
                        <svg class="check-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        Built with modern tech
                    </li>
                    <li>
                        <svg class="check-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        Made by iCommits
                    </li>
                </ul>

                <div class="stats-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Demo Only
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Tabs functionality
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            
            this.classList.add('active');
            const tabName = this.dataset.tab;
            document.getElementById(tabName).classList.add('active');
        });
    });
</script>
@endpush