@extends('layouts.landing-page.master')

@section('title', 'Invoice #' . $order->id)

@section('content')
@push('css')
<style>
    .invoice-card {
        background: #fff;
        border: none;
        border-radius: 24px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .invoice-header {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 40px;
        border-bottom: 1px solid #e2e8f0;
    }

    .status-badge {
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Logic warna status */
    .status-pending { background: #fef3c7; color: #92400e; }
    .status-completed { background: #d1fae5; color: #065f46; }
    .status-cancelled { background: #fee2e2; color: #991b1b; }

    .table-modern thead {
        background: #f8fafc;
    }
    .table-modern th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        color: #64748b;
        letter-spacing: 1px;
        border: none;
        padding: 20px;
    }
    .table-modern td {
        padding: 20px;
        vertical-align: middle;
        color: #1e293b;
        border-color: #f1f5f9;
    }

    .total-section {
        background: #f8fafc;
        padding: 30px;
        border-radius: 16px;
    }

    @media print {
        .btn-print { display: none; }
        .invoice-card { box-shadow: none; border: 1px solid #eee; }
    }
</style>
@endpush

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Detail Pesanan</h3>
        <button onclick="window.print()" class="btn btn-outline-primary rounded-pill px-4 btn-print">
            <i class="bi bi-printer me-2"></i> Cetak Invoice
        </button>
    </div>

    <div class="card invoice-card">
        {{-- HEADER INVOICE --}}
        <div class="invoice-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-primary fw-bold mb-1">Nomor Pesanan</p>
                    <h4 class="fw-bold text-dark">#INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h4>
                    <p class="text-muted mb-0 small">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <span class="status-badge status-{{ strtolower($order->status) }}">
                        <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i>
                        {{ $order->status }}
                    </span>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            {{-- RINCIAN TABEL --}}
            <div class="table-responsive mb-4">
                <table class="table table-modern">
                    <thead>
                        <tr>
                            <th>Item Souvenir</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $item->souvenir->nama_produk }}</div>
                                <small class="text-muted">{{ $item->souvenir->category?->nama_kategori }}</small>
                            </td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-end">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="text-end fw-bold">Rp {{ number_format($item->harga * $item->qty, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- FOOTER PERHITUNGAN --}}
            <div class="row justify-content-end">
                <div class="col-md-5">
                    <div class="total-section">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal Produk</span>
                            <span class="text-dark fw-semibold">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Biaya Layanan</span>
                            <span class="text-dark fw-semibold">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between border-top pt-3">
                            <span class="fw-bold text-dark fs-5">Total Bayar</span>
                            <span class="fw-bold text-primary fs-5">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 text-center">
                <p class="text-muted small">Terima kasih telah berbelanja souvenir di platform kami.<br>
                Jika ada kendala, hubungi customer service kami dengan menyertakan Nomor Pesanan di atas.</p>
                <a href="{{ route('souvenirs.index') }}" class="btn btn-link text-decoration-none btn-print">Kembali Belanja</a>
            </div>
        </div>
    </div>
</div>
@endsection