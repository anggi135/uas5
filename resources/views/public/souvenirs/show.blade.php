@extends('layouts.landing-page.master')

@section('title', $souvenir->nama_produk)

@section('content')
<div class="container py-5">

    <div class="row g-4">

        {{-- GAMBAR --}}
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                @if($souvenir->gambar)
                    <img src="{{ asset('storage/'.$souvenir->gambar) }}"
                         class="img-fluid rounded">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center"
                         style="height:300px">
                        <span class="text-muted">No Image</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- DETAIL --}}
        <div class="col-md-7">
            <h3 class="fw-bold mb-2">
                {{ $souvenir->nama_produk }}
            </h3>

            <p class="text-muted mb-1">
                Kategori:
                <span class="fw-semibold">
                    {{ $souvenir->category?->nama_kategori }}
                </span>
            </p>

            <h4 class="text-primary fw-bold mb-3">
                Rp {{ number_format($souvenir->harga, 0, ',', '.') }}
            </h4>

            <p class="mb-3">
                Stok:
                <span class="fw-semibold">
                    {{ $souvenir->stok }}
                </span>
            </p>

            <hr>

            {{-- DESKRIPSI (JIKA ADA) --}}
            @if($souvenir->deskripsi)
                <p class="text-muted">
                    {{ $souvenir->deskripsi }}
                </p>
            @else
                <p class="text-muted fst-italic">
                    Tidak ada deskripsi produk.
                </p>
            @endif

            {{-- ACTION --}}
            <div class="d-flex gap-2 mt-4">

                @auth
                    <a href="{{ route('orders.create', ['souvenir_id' => $souvenir->id]) }}"
                       class="btn btn-primary">
                        🛒 Beli Sekarang
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="btn btn-primary">
                        Login untuk Beli
                    </a>
                @endauth

                <a href="{{ route('souvenirs.index') }}"
                   class="btn btn-outline-secondary">
                    ← Kembali
                </a>
            </div>
        </div>

    </div>

</div>
@endsection
