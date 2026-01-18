@extends('layouts.landing-page.master')

@section('title', 'Edit Souvenir - ' . $souvenir->nama_produk)

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

    .btn-update {
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 700;
        transition: all 0.3s;
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(13, 110, 253, 0.2);
    }

    .current-image-wrapper {
        background: #f1f5f9;
        padding: 15px;
        border-radius: 16px;
        display: inline-block;
        border: 1px solid #e2e8f0;
    }
</style>
@endpush

<div class="container admin-container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            {{-- HEADER --}}
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('admin.souvenirs.index') }}" class="btn btn-light rounded-circle me-3 shadow-sm">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h3 class="fw-bold text-dark m-0">Edit Souvenir</h3>
                    <p class="text-muted small mb-0">Perbarui informasi produk secara berkala untuk menjaga akurasi data.</p>
                </div>
            </div>

            {{-- ERROR HANDLING --}}
            @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i> Terjadi Kesalahan:</div>
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-card">
                <form action="{{ route('admin.souvenirs.update', $souvenir->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $souvenir->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" value="{{ $souvenir->nama_produk }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Harga Satuan</label>
                            <div class="input-group">
                                <span class="input-group-text border-0" style="border-radius: 12px 0 0 12px;">Rp</span>
                                <input type="number" name="harga" value="{{ $souvenir->harga }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" value="{{ $souvenir->stok }}" class="form-control" min="0" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Deskripsi Produk</label>
                        <textarea name="deskripsi" class="form-control" rows="5" placeholder="Tuliskan deskripsi produk di sini...">{{ $souvenir->deskripsi }}</textarea>
                    </div>

                    <div class="mb-5">
                        <label class="form-label">Gambar Produk</label>
                        <div class="mb-3">
                            @if($souvenir->gambar)
                                <div class="current-image-wrapper">
                                    <img src="{{ asset('storage/'.$souvenir->gambar) }}" 
                                         width="120" 
                                         height="90" 
                                         style="object-fit: contain;" 
                                         class="rounded-3 shadow-sm d-block mb-2">
                                    <span class="badge bg-white text-muted border fw-normal" style="font-size: 0.7rem;">Gambar Saat Ini</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="mt-2">
                            <input type="file" name="gambar" class="form-control" id="imageInput">
                            <small class="text-muted d-block mt-2">Pilih file baru jika ingin mengganti gambar.</small>
                        </div>

                        {{-- PRATINJAU GAMBAR BARU --}}
                        <div id="imagePreview" class="mt-3 d-none">
                            <img src="" class="rounded-3 shadow-sm" style="width: 120px; height: 90px; object-fit: contain; border: 2px solid #0d6efd;">
                            <p class="small text-primary fw-bold mt-1"><i class="bi bi-eye"></i> Pratinjau Gambar Baru</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-4">
                        <a href="{{ route('admin.souvenirs.index') }}" class="btn btn-light px-4 py-2 rounded-pill fw-bold">Batal</a>
                        <button type="submit" class="btn btn-primary btn-update px-5 rounded-pill shadow-sm">
                            <i class="bi bi-cloud-arrow-up me-1"></i> Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    // JS untuk pratinjau gambar baru secara instan
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