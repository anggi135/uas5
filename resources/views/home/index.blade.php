@extends('layouts.landing-page.master')

@section('title', 'Home')

@section('content')

@push('css')
<style>
    body { background:#f6f8fb; }
    .sidebar { background:#fff; border-radius:12px; }
    .sidebar a { color:#333; font-size:14px; text-decoration:none; }
    .sidebar a:hover { color:#0d6efd; }

    .hero-banner {
        background:#eef6ff;
        border-radius:16px;
        padding:50px;
    }

    .promo-card {
        border-radius:14px;
        border:none;
        transition:.2s;
    }
    .promo-card:hover {
        transform:translateY(-4px);
        box-shadow:0 10px 25px rgba(0,0,0,.08);
    }

    .product-card {
        border:none;
        border-radius:14px;
        background:#fff;
        transition:.2s;
    }
    .product-card:hover {
        transform:translateY(-4px);
        box-shadow:0 8px 20px rgba(0,0,0,.08);
    }

    .discount-badge {
        position:absolute;
        top:10px;
        left:10px;
        background:#ff5a5f;
        color:#fff;
        font-size:12px;
        padding:4px 8px;
        border-radius:6px;
    }
</style>
@endpush

<div class="container py-4">

    <div class="row g-4">

        {{-- SIDEBAR --}}
        <div class="col-lg-3">
    <div class="sidebar p-3">
        <h6 class="fw-bold mb-3">Kategori</h6>

        <ul class="list-unstyled mb-0">
            <li class="mb-2">
                <a href="{{ route('souvenirs.index') }}">Semua Produk</a>
            </li>

            @foreach($categories as $category)
                <li class="mb-2">
                    <a href="{{ route('souvenirs.index', ['category' => $category->id]) }}">
                        {{ $category->nama_kategori }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>


        {{-- MAIN CONTENT --}}
        <div class="col-lg-9">

            {{-- HERO --}}
            <div class="hero-banner mb-4 d-flex align-items-center justify-content-between">
                <div>
                    <small class="text-primary fw-semibold">Promo Spesial</small>
                    <h2 class="fw-bold mt-2 mb-3">
                        Koleksi <span class="text-primary">Souvenir Terbaik</span>
                    </h2>
                    <a href="#produk" class="btn btn-primary px-4">
                        Belanja Sekarang
                    </a>
                </div>

                <div class="d-none d-md-block">
                    <img src="https://via.placeholder.com/260x260"
                         class="img-fluid" alt="Souvenir">
                </div>
            </div>

            {{-- PROMO --}}
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card promo-card p-3">
                        <small class="text-muted">Bundle</small>
                        <h6 class="fw-bold mt-1">Hemat Lebih Banyak</h6>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card promo-card p-3">
                        <small class="text-muted">Diskon</small>
                        <h6 class="fw-bold mt-1">Harga Terbaik</h6>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card promo-card p-3">
                        <small class="text-muted">Terbaru</small>
                        <h6 class="fw-bold mt-1">Produk Eksklusif</h6>
                    </div>
                </div>
            </div>

            {{-- PRODUK --}}
            <h5 class="fw-bold mb-3">Produk Unggulan</h5>

            <div class="row g-4" id="produk">
                @forelse($souvenirs ?? [] as $item)
                    <div class="col-md-3 col-sm-6">
                        <div class="card product-card position-relative h-100">

                            <span class="discount-badge">HOT</span>

                            <div class="bg-light rounded-top d-flex align-items-center justify-content-center"
                                 style="height:160px">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}"
                                         class="img-fluid"
                                         style="max-height:140px">
                                @else
                                    <small class="text-muted">No Image</small>
                                @endif
                            </div>

                            <div class="card-body">
                                <h6 class="fw-bold mb-1">
                                    {{ $item->nama_produk }}
                                </h6>

                                <small class="text-muted d-block mb-2">
                                    {{ $item->category?->nama_kategori ?? '-' }}
                                </small>

                                <div class="fw-bold text-primary mb-3">
                                    Rp {{ number_format($item->harga,0,',','.') }}
                                </div>

                                <a href="{{ route('orders.create', ['souvenir_id' => $item->id]) }}"
                                   class="btn btn-outline-primary btn-sm w-100">
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        Belum ada produk tersedia
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection
