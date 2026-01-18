@extends('layouts.landing-page.master')

@section('title', 'Home - Koleksi Eksklusif')

@section('content')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-color: #0d6efd;
        --soft-bg: #f8fafc;
        --card-shadow: 0 10px 30px -10px rgba(0,0,0,0.07);
    }

    body { background: var(--soft-bg); font-family: 'Plus Jakarta Sans', sans-serif; }

    /* Custom Dropdown Kategori */
    .category-dropdown .btn-category {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.1);
        padding: 12px 20px;
        border-radius: 12px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: 0.3s;
    }
    .category-dropdown .btn-category:hover { background: #f1f5f9; }
    .category-dropdown .dropdown-menu {
        border-radius: 12px;
        border: none;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        width: 100%;
        padding: 8px;
    }
    .category-dropdown .dropdown-item {
        border-radius: 8px;
        padding: 10px;
    }

    /* Hero Slider Styles */
    .hero-swiper {
        border-radius: 24px;
        overflow: hidden;
        margin-bottom: 40px;
    }
    .hero-slide {
        background: linear-gradient(135deg, #eef6ff 0%, #ffffff 100%);
        padding: 60px;
        min-height: 350px;
        display: flex;
        align-items: center;
        border: 1px solid rgba(13, 110, 253, 0.1);
    }

    /* Product Card Slider */
    .product-swiper {
        padding: 20px 5px 50px 5px;
    }
    .product-card {
        border: none;
        border-radius: 20px;
        background: #fff;
        transition: all 0.4s;
        box-shadow: var(--card-shadow);
        height: 100%;
    }
    .product-card:hover { transform: translateY(-8px); }
    .img-container {
        height: 200px;
        background: #f1f5f9;
        border-radius: 20px 20px 0 0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .img-container img { transition: 0.5s; max-height: 160px; }
    .product-card:hover .img-container img { transform: scale(1.1); }

    .discount-badge {
        position: absolute;
        top: 15px; left: 15px;
        background: #10b981;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 50px;
        z-index: 10;
    }

    /* Swiper Pagination Color */
    .swiper-pagination-bullet-active { background: var(--primary-color) !important; }
</style>
@endpush

<div class="container py-4">
    <div class="row g-4">
        
        {{-- TOP BAR: Kategori & Search --}}
        <div class="col-12 mb-2">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="dropdown category-dropdown">
                        <button class="btn-category dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <span class="fw-bold"><i class="bi bi-grid-fill me-2"></i> Pilih Kategori</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('souvenirs.index') }}">Semua Produk</a></li>
                            @foreach($categories as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route('souvenirs.index', ['category' => $category->id]) }}">
                                        {{ $category->nama_kategori }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 d-none d-md-block">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 shadow-sm p-3 rounded-start-pill" placeholder="Cari souvenir impian Anda..." style="background: #fff;">
                        <button class="btn btn-primary px-4 rounded-end-pill shadow-sm">Cari</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- HERO SLIDER --}}
        <div class="col-12">
            <div class="swiper hero-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide hero-slide">
                        <div class="row w-100 align-items-center">
                            <div class="col-md-7">
                                <span class="badge bg-primary-soft text-primary mb-2 px-3 py-2 rounded-pill" style="background: rgba(13,110,253,0.1)">Flash Sale!</span>
                                <h1 class="display-5 fw-bold text-dark">Koleksi Souvenir <span class="text-primary">Eksklusif</span></h1>
                                <p class="text-muted mb-4">Dapatkan diskon hingga 50% untuk pembelian pertama produk kustom kami.</p>
                                <a href="#produk" class="btn btn-primary btn-lg rounded-pill px-5">Belanja Sekarang</a>
                            </div>
                            <div class="col-md-5 d-none d-md-block text-center">
                                <img src="https://via.placeholder.com/300" class="img-fluid" alt="Promo">
                            </div>
                        </div>
                    </div>
                    </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        {{-- PRODUCT SLIDER --}}
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Produk Unggulan</h4>
                <div class="d-flex gap-2">
                    <div class="swiper-button-prev-custom btn btn-white border rounded-circle"><i class="bi bi-chevron-left"></i></div>
                    <div class="swiper-button-next-custom btn btn-white border rounded-circle"><i class="bi bi-chevron-right"></i></div>
                </div>
            </div>

            <div class="swiper product-swiper">
                <div class="swiper-wrapper">
                    @forelse($souvenirs ?? [] as $item)
                        <div class="swiper-slide">
                            <div class="card product-card position-relative">
                                <span class="discount-badge">TRENDING</span>
                                <div class="img-container">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/'.$item->gambar) }}" class="img-fluid">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </div>
                                <div class="card-body p-4">
                                    <small class="text-muted d-block mb-1">{{ $item->category?->nama_kategori ?? '-' }}</small>
                                    <h6 class="fw-bold mb-2 text-dark text-truncate">{{ $item->nama_produk }}</h6>
                                    <h5 class="fw-bold text-primary mb-3">Rp {{ number_format($item->harga,0,',','.') }}</h5>
                                    <a href="{{ route('orders.create', ['souvenir_id' => $item->id]) }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill py-2">
                                        Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center w-100 py-5">
                            <p class="text-muted">Produk tidak tersedia.</p>
                        </div>
                    @endforelse
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

    </div>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Initialize Hero Slider
    new Swiper('.hero-swiper', {
        loop: true,
        autoplay: { delay: 5000 },
        pagination: { el: '.swiper-pagination', clickable: true },
    });

    // Initialize Product Slider
    new Swiper('.product-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        pagination: { el: '.swiper-pagination', clickable: true },
        navigation: {
            nextEl: '.swiper-button-next-custom',
            prevEl: '.swiper-button-prev-custom',
        },
        breakpoints: {
            640: { slidesPerView: 2 },
            1024: { slidesPerView: 4 },
        }
    });
</script>
@endpush
@endsection