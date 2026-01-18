@extends('layouts.landing-page.master')

@section('title', 'Tambah Souvenir Baru')

@section('content')
@push('css')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; }
    
    .admin-container { padding: 40px 20px; }
    
    .form-card {
        background: #fff;
        border-radius: 24px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.03);
        padding: 40px;
    }

    .form-label {
        font-weight: 600;
        color: #475569;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .form-control, .form-select {
        border-radius: 12px;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        background-color: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }

    .btn-save {
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 700;
        transition: all 0.3s;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(25, 135, 84, 0.2);
    }

    .input-group-text {
        background-color: #e2e8f0;
        border: none;
        border-radius: 12px 0 0 12px;
    }
</style>
@endpush

<div class="container admin-container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('admin.souvenirs.index') }}" class="btn btn-light rounded-circle me-3 shadow-sm">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h3 class="fw-bold text-dark m-0">Tambah Souvenir Baru</h3>
                    <p class="text-muted small mb-0">Inputkan detail produk dengan lengkap dan benar.</p>
                </div>
            </div>

            <div class="form-card">
                <form action="{{ route('admin.souvenirs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Kategori Produk</label>
                            <select name="category_id" class="form-select" required>
                                <option value="" selected disabled>Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" placeholder="Contoh: Mug Keramik Kustom" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Harga Satuan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga" class="form-control" placeholder="0" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Stok Barang</label>
                            <input type="number" name="stok" class="form-control" value="0" min="0" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Deskripsi Lengkap</label>
                        <textarea name="deskripsi" class="form-control" rows="4" placeholder="Jelaskan detail bahan, ukuran, dll..."></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Foto Produk</label>
                        <input type="file" name="gambar" class="form-control" id="imageInput">
                        <div id="imagePreview" class="mt-3 d-none">
                            <img src="" class="rounded-3 shadow-sm" style="width: 150px; height: 100px; object-fit: contain; border: 1px solid #e2e8f0;">
                            <p class="small text-muted mt-1">Pratinjau Gambar</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-4">
                        <a href="{{ route('admin.souvenirs.index') }}" class="btn btn-light px-4 py-2 rounded-pill fw-bold">Batal</a>
                        <button type="submit" class="btn btn-success btn-save px-5 rounded-pill">
                            <i class="bi bi-check-circle me-1"></i> Simpan Souvenir
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    // Fitur pratinjau gambar otomatis sebelum diupload
    document.getElementById('imageInput').onchange = evt => {
        const [file] = document.getElementById('imageInput').files
        if (file) {
            const preview = document.getElementById('imagePreview');
            preview.classList.remove('d-none');
            preview.querySelector('img').src = URL.createObjectURL(file)
        }
    }
</script>
@endpush
@endsection