@extends('layouts.admin')

@section('title', 'Discover Demo Websites')

@push('styles')
<style>
    .showcase-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .hero-section {
        text-align: center;
        margin-bottom: 40px;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    .hero-title {
        font-size: 56px;
        font-weight: 700;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .hero-title .highlight {
        color: #2563eb;
    }

    .hero-subtitle {
        font-size: 18px;
        color: #6b7280;
        margin-bottom: 30px;
    }

    .hero-subtitle a {
        color: #2563eb;
        text-decoration: none;
    }

    .search-box {
        max-width: 600px;
        margin: 0 auto 30px;
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 14px 20px 14px 45px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 16px;
    }

    .search-box svg {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    .filter-tabs {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 40px;
    }

    .filter-tab {
        padding: 10px 20px;
        border: none;
        background: #f3f4f6;
        border-radius: 6px;
        cursor: pointer;
        font-size: 15px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .filter-tab.active {
        background: #2563eb;
        color: white;
    }

    .filter-tab:hover {
        background: #e5e7eb;
    }

    .filter-tab.active:hover {
        background: #1d4ed8;
    }

    .controls-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .sort-dropdown {
        padding: 10px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
    }

    .toggle-switch {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .switch {
        position: relative;
        width: 44px;
        height: 24px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #e5e7eb;
        transition: .4s;
        border-radius: 24px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #2563eb;
    }

    input:checked + .slider:before {
        transform: translateX(20px);
    }

    .showcase-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .showcase-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        cursor: pointer;
        background: white;
    }

    .showcase-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    }

    .card-thumbnail {
        width: 100%;
        height: 280px;
        object-fit: cover;
        display: block;
    }

    .card-info {
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .card-details {
        flex: 1;
    }

    .card-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 4px;
        color: #111827;
    }

    .card-author {
        font-size: 14px;
        color: #6b7280;
    }

    .card-stats {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 14px;
        color: #6b7280;
    }

    .showcase-btn {
        display: inline-block;
        padding: 12px 24px;
        background: #2563eb;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.3s;
    }

    .showcase-btn:hover {
        background: #1d4ed8;
        color: white;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 36px;
        }

        .showcase-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="showcase-container">
    <div class="hero-section">
        <div class="badge">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2">
                <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                <path d="M2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
            Made in Webflow
        </div>
        
        <h1 class="hero-title">
            Discover <span class="highlight">Demo</span> websites<br>
            built by the Webflow community
        </h1>
        
        <p class="hero-subtitle">
            Browse, clone, and customize thousands of websites #MadeinWebflow. 
            <a href="#">Looking for templates?</a>
        </p>

        <div class="search-box">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
            <input type="text" placeholder="Search" id="searchInput">
        </div>

        <div class="filter-tabs">
            <button class="filter-tab" data-filter="all">All</button>
            <button class="filter-tab active" data-filter="demo">Demo</button>
            <button class="filter-tab" data-filter="animation">Animation</button>
            <button class="filter-tab" data-filter="interactions">Interactions</button>
            <button class="filter-tab" data-filter="cms">CMS</button>
            <button class="filter-tab" data-filter="ecommerce">Ecommerce</button>
            <button class="filter-tab" data-filter="portfolio">Portfolio</button>
        </div>
    </div>

    <div class="controls-bar">
        <div>
            <select class="sort-dropdown" id="sortBy">
                <option value="liked">Most liked</option>
                <option value="recent">Most recent</option>
                <option value="viewed">Most viewed</option>
            </select>
        </div>

        <div class="toggle-switch">
            <span>Cloneable sites only</span>
            <label class="switch">
                <input type="checkbox" id="cloneableOnly">
                <span class="slider"></span>
            </label>
            <span style="color: #9ca3af; cursor: help;">?</span>
        </div>

        <a href="#" class="showcase-btn">Showcase your site</a>
    </div>

    <div class="showcase-grid" id="showcaseGrid">
        @foreach($showcases as $item)
        <div class="showcase-card" data-category="{{ $item->category }}">
            <img src="{{ $item->thumbnail }}" alt="{{ $item->title }}" class="card-thumbnail">
            
            <div class="card-info">
                <img src="{{ $item->author_avatar }}" alt="{{ $item->author }}" class="card-avatar">
                
                <div class="card-details">
                    <div class="card-title">{{ $item->title }}</div>
                    <div class="card-author">{{ $item->author }}</div>
                </div>

                <div class="card-stats">
                    <div class="stat-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        <span>{{ number_format($item->likes) }}</span>
                    </div>
                    <div class="stat-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <span>{{ number_format($item->views / 1000, 1) }}k</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Filter functionality
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            const cards = document.querySelectorAll('.showcase-card');
            
            cards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.showcase-card');
        
        cards.forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const author = card.querySelector('.card-author').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || author.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Sort functionality
    document.getElementById('sortBy').addEventListener('change', function() {
        // Implement sorting logic here
        console.log('Sort by:', this.value);
    });

    // Cloneable toggle
    document.getElementById('cloneableOnly').addEventListener('change', function() {
        console.log('Cloneable only:', this.checked);
    });
</script>
@endpush