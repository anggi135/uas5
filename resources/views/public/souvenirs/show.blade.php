@extends('layouts.landing-page.master')

@section('title', $souvenir->nama_produk)

@section('content')
@push('css')
<style>
    :root {
        --glass-bg: rgba(255, 255, 255, 0.8);
    }

    .product-detail-container {
        background: #fff;
        border-radius: 30px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.05);
        padding: 40px;
        margin-top: 20px;
    }

    .main-product-img {
        border-radius: 20px;
        width: 100%;
        transition: transform 0.5s ease;
        cursor: zoom-in;
    }

    .main-product-img:hover {
        transform: scale(1.02);
    }

    .badge-category {
        background: #eef6ff;
        color: #0d6efd;
        padding: 6px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
    }

    .price-large {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1e293b;
    }

    .stock-indicator {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }

    .dot {
        height: 10px;
        width: 10px;
        border-radius: 50%;
        display: inline-block;
    }

    .btn-buy-lg {
        padding: 16px 32px;
        border-radius: 16px;
        font-weight: 700;
        font-size: 1.1rem;
        box-shadow: 0 10px 20px rgba(13, 110, 253, 0.2);
        transition: 0.3s;
    }

    .btn-buy-lg:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(13, 110, 253, 0.3);
    }

    .description-box {
        line-height: 1.8;
        color: #64748b;
        font-size: 1.05rem;
    }

    .info-card {
        background: #f8fafc;
        border-radius: 16px;
        padding: 15px;
        border: 1px solid #f1f5f9;
    }
</style>
@endpush

<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('souvenirs.index') }}" class="text-decoration-none">Katalog</a></li>
            <li class="breadcrumb-item active">{{ $souvenir->category?->nama_kategori }}</li>
        </ol>
    </nav>

    <div class="product-detail-container">
        <div class="row g-5">
            {{-- GAMBAR PRODUK --}}
            <div class="col-md-5">
                <div class="position-relative overflow-hidden rounded-4 bg-light">
                    @if($souvenir->gambar)
                        <img src="{{ asset('storage/'.$souvenir->gambar) }}" 
                             class="main-product-img shadow-sm" 
                             alt="{{ $souvenir->nama_produk }}">
                    @else
                        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px;">
                            <i class="bi bi-image text-muted" style="font-size: 5rem;"></i>
                            <p class="text-muted mt-2">Gambar tidak tersedia</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- INFORMASI PRODUK --}}
            <div class="col-md-7">
                <div class="ps-md-4">
                    <span class="badge-category mb-3">
                        <i class="bi bi-tag-fill me-1"></i> {{ $souvenir->category?->nama_kategori }}
                    </span>
                    
                    <h1 class="fw-bold text-dark mb-3">{{ $souvenir->nama_produk }}</h1>
                    
                    <div class="price-large mb-4">
                        Rp {{ number_format($souvenir->harga, 0, ',', '.') }}
                    </div>

                    <div class="row mb-4">
                        <div class="col-6 col-md-4">
                            <div class="info-card">
                                <small class="text-muted d-block mb-1">Status Stok</small>
                                <div class="stock-indicator">
                                    <span class="dot {{ $souvenir->stok > 0 ? 'bg-success' : 'bg-danger' }}"></span>
                                    <span class="fw-bold">{{ $souvenir->stok > 0 ? 'Tersedia' : 'Habis' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="info-card">
                                <small class="text-muted d-block mb-1">Jumlah Stok</small>
                                <span class="fw-bold fs-5 text-dark">{{ $souvenir->stok }} <small class="text-muted fs-6">pcs</small></span>
                            </div>
                        </div>
                    </div>

                    <div class="description-box mb-5">
                        <h6 class="fw-bold text-dark mb-2">Deskripsi Produk</h6>
                        @if($souvenir->deskripsi)
                            <p>{!! nl2br(e($souvenir->deskripsi)) !!}</p>
                        @else
                            <p class="fst-italic text-muted">Pemilik belum menambahkan deskripsi untuk produk ini.</p>
                        @endif
                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="d-flex flex-column flex-md-row gap-3">
                        @auth
                            <a href="{{ route('orders.create', ['souvenir_id' => $souvenir->id]) }}" 
                               class="btn btn-primary btn-buy-lg flex-grow-1">
                                <i class="bi bi-cart-check-fill me-2"></i> Beli Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-buy-lg flex-grow-1">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Login untuk Membeli
                            </a>
                        @endauth
                        
                        <a href="{{ route('souvenirs.index') }}" 
                           class="btn btn-outline-secondary rounded-4 px-4 d-flex align-items-center justify-content-center">
                            <i class="bi bi-arrow-left me-2"></i> Kembali
                        </a>
                    </div>

                    <div class="mt-4 p-3 rounded-4 bg-light">
                        <small class="text-muted">
                            <i class="bi bi-shield-check text-success me-1"></i> 
                            Transaksi di platform ini aman dan terenkripsi.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection