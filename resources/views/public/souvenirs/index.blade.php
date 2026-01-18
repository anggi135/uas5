@extends('layouts.landing-page.master')

@section('title', 'Katalog Souvenir Eksklusif')

@section('content')
@push('css')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #0d6efd 0%, #004dc7 100%);
        --soft-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    /* Search & Filter Section */
    .filter-wrapper {
        background: #fff;
        padding: 30px;
        border-radius: 20px;
        box-shadow: var(--soft-shadow);
        margin-bottom: 40px;
        border: 1px solid rgba(0,0,0,0.03);
    }

    .form-control-modern {
        border-radius: 12px;
        padding: 12px 20px;
        border: 1px solid #e2e8f0;
        transition: 0.3s;
    }

    .form-control-modern:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }

    /* Card Styling */
    .catalog-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: var(--soft-shadow);
    }

    .catalog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .catalog-img-wrapper {
        position: relative;
        height: 220px;
        overflow: hidden;
        background: #f8fafc;
    }

    .catalog-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s;
    }

    .catalog-card:hover .catalog-img-wrapper img {
        transform: scale(1.1);
    }

    .price-tag {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0d6efd;
    }

    /* Update Button Action agar konsisten */
    .btn-action {
        border-radius: 12px;
        font-weight: 600;
        padding: 10px 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }

    .btn-cart-only {
        width: 45px; /* Lebar tetap untuk icon keranjang */
        padding: 10px 0;
    }

    /* Category Badge overlay */
    .category-badge-overlay {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        color: #475569;
    }
</style>
@endpush

<div class="container py-5">
    {{-- HEADER --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">Eksplorasi Katalog</h2>
        <p class="text-muted mx-auto" style="max-width: 600px;">
            Pilih dari ratusan koleksi souvenir unik yang dirancang khusus untuk memperingati setiap momen berharga Anda.
        </p>
    </div>

    {{-- SEARCH & FILTER --}}
    <div class="filter-wrapper">
        <form method="GET" action="{{ route('souvenirs.index') }}" class="row g-3">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-0 pe-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="search" value="{{ htmlspecialchars(request('search')) }}" 
                           class="form-control form-control-modern border-0 shadow-none" 
                           placeholder="Cari nama souvenir...">
                </div>
            </div>

            <div class="col-md-4">
                <select name="category" class="form-select form-control-modern">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-primary btn-action shadow-sm">
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    {{-- LIST PRODUK --}}
    <div class="row g-4">
        @forelse($souvenirs as $souvenir)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card catalog-card h-100">
                    <div class="catalog-img-wrapper">
                        @if($souvenir->gambar)
                            <img src="{{ asset('storage/'.$souvenir->gambar) }}" alt="{{ $souvenir->nama_produk }}">
                        @else
                            <div class="h-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>
                        @endif
                        <span class="category-badge-overlay shadow-sm">
                            {{ $souvenir->category?->nama_kategori ?? 'Umum' }}
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column p-4">
                        <h6 class="fw-bold text-dark mb-1">{{ $souvenir->nama_produk }}</h6>
                        <div class="price-tag mb-4 mt-1">
                            Rp {{ number_format($souvenir->harga, 0, ',', '.') }}
                        </div>

                        <div class="mt-auto d-flex gap-2">
                            {{-- Tombol Detail (Lebih Dominan) --}}
                            <a href="{{ route('souvenirs.show', $souvenir->id) }}" 
                               class="btn btn-light text-primary btn-action flex-grow-1 border-0">
                                Detail
                            </a>

                            {{-- Tombol Keranjang (Icon Only) --}}
                            @auth
                                <a href="{{ route('orders.create', ['souvenir_id' => $souvenir->id]) }}" 
                                   class="btn btn-primary btn-action btn-cart-only shadow-sm">
                                    <i class="bi bi-cart-plus-fill"></i>
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="btn btn-outline-primary btn-action btn-cart-only">
                                    <i class="bi bi-cart-plus"></i>
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="bg-light d-inline-block p-4 rounded-circle mb-3">
                    <i class="bi bi-search fs-1 text-muted"></i>
                </div>
                <h5 class="text-dark fw-bold">Ups! Souvenir tidak ditemukan</h5>
                <p class="text-muted">Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
                <a href="{{ route('souvenirs.index') }}" class="btn btn-primary rounded-pill">Reset Pencarian</a>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $souvenirs->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection