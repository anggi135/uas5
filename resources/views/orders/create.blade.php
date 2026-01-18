@extends('layouts.landing-page.master')

@section('title', 'Selesaikan Pesanan')

@section('content')
@push('css')
<style>
    :root {
        --subtle-bg: #fdfdfe;
    }

    .checkout-container {
        max-width: 1000px;
        margin: auto;
    }

    .order-card {
        border: none;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    }

    .product-summary {
        background: var(--subtle-bg);
        border-radius: 16px;
        padding: 20px;
        border: 1px dashed #e2e8f0;
    }

    .qty-input {
        max-width: 120px;
        border-radius: 10px;
        padding: 10px;
        border: 1px solid #cbd5e1;
    }

    .btn-confirm {
        padding: 15px 30px;
        border-radius: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: 0.3s;
    }

    .price-summary-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 15px;
    }
</style>
@endpush

<div class="container py-5 checkout-container">
    <div class="mb-4">
        <h2 class="fw-bold text-dark">Konfirmasi Pesanan</h2>
        <p class="text-muted">Satu langkah lagi untuk mendapatkan souvenir eksklusif Anda.</p>
    </div>

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <input type="hidden" name="souvenir_id" value="{{ $souvenir->id }}">

        <div class="row g-4">
            {{-- KOLOM KIRI: PRODUK --}}
            <div class="col-lg-7">
                <div class="card order-card p-4">
                    <h5 class="fw-bold mb-4">Informasi Produk</h5>
                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="rounded-3 overflow-hidden bg-light" style="width: 100px; height: 100px;">
                            @if($souvenir->gambar)
                                <img src="{{ asset('storage/'.$souvenir->gambar) }}" class="w-100 h-100 object-fit-cover">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image text-muted fs-4"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">{{ $souvenir->nama_produk }}</h6>
                            <p class="text-primary fw-bold mb-1">Rp {{ number_format($souvenir->harga, 0, ',', '.') }}</p>
                            <small class="text-muted">Kategori: {{ $souvenir->category?->nama_kategori }}</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Jumlah Pesanan</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="number" name="qty" id="qtyInput" 
                                   class="form-control qty-input shadow-sm" 
                                   value="1" min="1" max="{{ $souvenir->stok }}" required>
                            <span class="text-muted small">Stok tersedia: <strong class="text-dark">{{ $souvenir->stok }}</strong></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: RINGKASAN PEMBAYARAN --}}
            <div class="col-lg-5">
                <div class="card order-card p-4 h-100">
                    <h5 class="fw-bold mb-4">Ringkasan Pembayaran</h5>
                    
                    <div class="price-summary-box mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Harga Satuan</span>
                            <span class="fw-semibold text-dark">Rp {{ number_format($souvenir->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Pajak (0%)</span>
                            <span class="fw-semibold text-dark">Rp 0</span>
                        </div>
                        <hr class="my-3 opacity-50">
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold text-dark fs-5">Total Bayar</span>
                            <span class="fw-bold text-primary fs-5" id="totalPriceDisplay">Rp {{ number_format($souvenir->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-confirm shadow-sm">
                            <i class="bi bi-lock-fill me-2"></i> Konfirmasi & Bayar
                        </button>
                        <a href="{{ route('souvenirs.show', $souvenir->id) }}" class="btn btn-link text-muted text-decoration-none small mt-2">
                            Batal & Kembali
                        </a>
                    </div>

                    <div class="mt-4 text-center">
                        <div class="d-flex justify-content-center gap-2 grayscale opacity-50">
                            <i class="bi bi-shield-lock-fill text-success"></i>
                            <small class="text-muted" style="font-size: 0.7rem;">Secure Payment Processing</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('js')
<script>
    // Script sederhana untuk update visual harga total (Real-time UX)
    const qtyInput = document.getElementById('qtyInput');
    const totalDisplay = document.getElementById('totalPriceDisplay');
    const unitPrice = {{ $souvenir->harga }};

    qtyInput.addEventListener('input', function() {
        let total = this.value * unitPrice;
        if (total < 0) total = 0;
        totalDisplay.innerText = 'Rp ' + total.toLocaleString('id-ID');
    });
</script>
@endpush
@endsection