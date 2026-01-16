@extends('layouts.landing-page.master')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">

    <h3 class="mb-4">Checkout</h3>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <input type="hidden" name="souvenir_id" value="{{ $souvenir->id }}">

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <h5>{{ $souvenir->nama_produk }}</h5>

                <p class="text-muted mb-1">
                    Harga:
                    <strong>
                        Rp {{ number_format($souvenir->harga, 0, ',', '.') }}
                    </strong>
                </p>

                <p class="text-muted">
                    Stok tersedia: {{ $souvenir->stok }}
                </p>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number"
                           name="qty"
                           class="form-control"
                           value="1"
                           min="1"
                           max="{{ $souvenir->stok }}"
                           required>
                </div>

            </div>
        </div>

        <button class="btn btn-primary">
            Buat Pesanan
        </button>

        <a href="{{ route('souvenirs.show', $souvenir->id) }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>
</div>
@endsection
