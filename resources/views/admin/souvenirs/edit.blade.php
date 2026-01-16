@extends('layouts.admin.master')

@section('content')
<div class="container mt-5">
    <h3>Edit Souvenir</h3>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('admin.souvenirs.update', $souvenir->id) }}"
      method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Kategori</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        @if($souvenir->category_id == $cat->id) selected @endif>
                        {{ $cat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk"
                   value="{{ $souvenir->nama_produk }}"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga"
                   value="{{ $souvenir->harga }}"
                   class="form-control">
        </div>

        <div class="mb-3">
    <label>Stok</label>
    <input type="number"
           name="stok"
           value="{{ $souvenir->stok }}"
           class="form-control"
           min="0">
</div>


        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi"
                      class="form-control">{{ $souvenir->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Gambar</label><br>
            @if($souvenir->gambar)
                <img src="{{ asset('storage/'.$souvenir->gambar) }}"
                     width="120" class="mb-2">
            @endif
            <input type="file" name="gambar" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
