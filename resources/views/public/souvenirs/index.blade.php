@extends('layouts.landing-page.master')

@section('title', 'Katalog Souvenir')

@section('content')
<div class="container py-5">

    {{-- JUDUL --}}
    <div class="mb-4 text-center">
        <h3 class="fw-bold">Katalog Souvenir</h3>
        <p class="text-muted">Temukan souvenir terbaik untuk acara spesialmu</p>
    </div>

    {{-- SEARCH & FILTER --}}
    <form method="GET" action="{{ route('souvenirs.index') }}" class="row g-2 mb-4">
        <div class="col-md-5">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Cari souvenir...">
        </div>

        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">-- Semua Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 d-grid">
            <button class="btn btn-primary">
                Cari
            </button>
        </div>
    </form>

    {{-- LIST PRODUK --}}
    <div class="row g-4">
        @forelse($souvenirs as $souvenir)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm border-0">

                    {{-- GAMBAR --}}
                    @if($souvenir->gambar)
                        <img src="{{ asset('storage/'.$souvenir->gambar) }}"
                             class="card-img-top"
                             style="height:180px; object-fit:cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="height:180px">
                            <span class="text-muted">No Image</span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-bold mb-1">
                            {{ $souvenir->nama_produk }}
                        </h6>

                        <small class="text-muted mb-2">
                            {{ $souvenir->category?->nama_kategori }}
                        </small>

                        <div class="fw-bold text-primary mb-3">
                            Rp {{ number_format($souvenir->harga,0,',','.') }}
                        </div>

                        <div class="mt-auto d-grid gap-2">
                            {{-- DETAIL --}}
                            <a href="{{ route('souvenirs.show', $souvenir->id) }}"
                               class="btn btn-outline-secondary btn-sm">
                                Detail
                            </a>

                            {{-- BELI --}}
                            @auth
                                <a href="{{ route('orders.create', ['souvenir_id' => $souvenir->id]) }}"
                                   class="btn btn-primary btn-sm">
                                    Beli
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                   class="btn btn-primary btn-sm">
                                    Login untuk Beli
                                </a>
                            @endauth
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Produk tidak ditemukan</p>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $souvenirs->links() }}
    </div>

</div>
@endsection
