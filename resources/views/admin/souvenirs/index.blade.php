@extends('layouts.landing-page.master')

@section('title', 'Data Souvenir')

@section('content')
@push('css')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; }
    .admin-container { padding: 40px 20px; }
    
    .custom-card {
        background: #fff;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        padding: 25px;
    }

    /* Table Styling */
    .table { border-collapse: separate; border-spacing: 0 10px; width: 100% !important; }
    .table thead th { 
        background: #f1f5f9; border: none; color: #64748b; 
        text-transform: uppercase; font-size: 11px; letter-spacing: 1px; padding: 15px;
    }
    .table tbody td { 
        padding: 15px; vertical-align: middle; 
        border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9;
        background: #fff;
    }

    /* Gambar styling agar tetap estetik tapi ukurannya terkunci */
    .img-admin-thumb {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        object-fit: cover; /* atau 'contain' jika ingin gambar utuh */
        display: block;
    }

    .btn-action { border-radius: 8px; font-weight: 600; padding: 5px 15px; }
    .table tbody td:first-child { border-left: 1px solid #f1f5f9; border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
    .table tbody td:last-child { border-right: 1px solid #f1f5f9; border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
</style>
@endpush

<div class="container admin-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark m-0">Data Souvenir</h3>
        <a href="{{ route('admin.souvenirs.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
            Tambah Souvenir
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">{{ session('success') }}</div>
    @endif

    <div class="custom-card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" width="50">No</th>
                        <th width="120">Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th class="text-center" width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($souvenirs as $no => $item)
                    <tr>
                        <td class="text-center text-muted fw-bold">{{ $no + 1 }}</td>
                        <td>
                            @if($item->gambar)
                                {{-- KUNCI UTAMA: Gunakan atribut width langsung --}}
                                <img src="{{ asset('storage/' . $item->gambar) }}" 
                                     width="80" 
                                     height="60" 
                                     class="img-admin-thumb shadow-sm">
                            @else
                                <small class="text-muted">No Image</small>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $item->nama_produk }}</div>
                            <small class="text-muted">ID: #{{ $item->id }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-primary rounded-pill px-3 py-2">
                                {{ $item->category?->nama_kategori ?? 'Umum' }}
                            </span>
                        </td>
                        <td>
                            <div class="fw-bold text-primary">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.souvenirs.edit', $item->id) }}" class="btn btn-warning btn-sm btn-action text-white shadow-sm">Edit</a>
                                <form action="{{ route('admin.souvenirs.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm btn-action shadow-sm" onclick="return confirm('Hapus data?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection