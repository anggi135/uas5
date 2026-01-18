@extends('layouts.landing-page.master')

@section('title', 'Riwayat Pesanan Saya')

@section('content')
@push('css')
<style>
    .dashboard-card {
        background: #fff;
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .table-modern-list thead th {
        background: #f8fafc;
        border: none;
        color: #64748b;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 20px;
    }

    .table-modern-list tbody td {
        padding: 20px;
        vertical-align: middle;
        border-color: #f1f5f9;
        color: #1e293b;
    }

    .order-id {
        font-family: 'Monaco', 'Consolas', monospace;
        color: #0d6efd;
        font-weight: 600;
        background: #eef6ff;
        padding: 4px 10px;
        border-radius: 6px;
    }

    /* Status Pill Badge */
    .status-pill {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .status-pending { background: #fffbeb; color: #b45309; }
    .status-completed { background: #ecfdf5; color: #047857; }
    .status-cancelled { background: #fef2f2; color: #b91c1c; }
    
    .dot-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }
    .status-pending .dot-indicator { background: #d97706; }
    .status-completed .dot-indicator { background: #10b981; }
    .status-cancelled .dot-indicator { background: #ef4444; }

    .btn-action-view {
        background: #fff;
        border: 1px solid #e2e8f0;
        color: #475569;
        border-radius: 10px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-action-view:hover {
        background: #f8fafc;
        color: #0d6efd;
        border-color: #0d6efd;
    }
</style>
@endpush

<div class="container py-5">
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h3 class="fw-bold text-dark m-0">Riwayat Pesanan</h3>
            <p class="text-muted mt-1">Pantau status pesanan souvenir Anda secara real-time.</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <a href="{{ route('souvenirs.index') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> Belanja Lagi
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 p-3 d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="dashboard-card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-modern-list m-0">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Penerima</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $no => $order)
                    <tr>
                        <td class="ps-4 text-muted">{{ $no + 1 }}</td>
                        <td><span class="order-id">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span></td>
                        <td class="small">{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="fw-bold">{{ $order->nama_pemesan }}</div>
                        </td>
                        <td>
                            <div class="fw-bold">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                        </td>
                        <td>
                            <div class="status-pill status-{{ strtolower($order->status) }}">
                                <span class="dot-indicator"></span>
                                {{ ucfirst($order->status) }}
                            </div>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-action-view btn-sm px-3">
                                <i class="bi bi-eye-fill me-1"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-cart-x fs-1 d-block mb-3"></i>
                                Belum ada pesanan yang dibuat.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection