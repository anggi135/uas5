@extends('layouts.admin.master')

@section('title', 'Data Souvenir')

@section('content')
<div class="container mt-5">
    <h3>Data Souvenir</h3>

    <a href="{{ route('admin.souvenirs.create') }}" class="btn btn-primary mb-3">
    Tambah Souvenir
</a>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>

        @foreach($souvenirs as $no => $item)
        <tr>
            <td>{{ $no + 1 }}</td>
            <td>
                @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" width="80">
                @else
                    <span class="text-muted">Tidak ada gambar</span>
                @endif
            </td>
            <td>{{ $item->nama_produk }}</td>
            <td>{{ $item->category?->nama_kategori ?? 'Tidak ada kategori' }}</td>
            <td>Rp {{ number_format($item->harga) }}</td>
            <td>
                <a href="{{ route('admin.souvenirs.edit', $item->id) }}"
   class="btn btn-warning btn-sm">Edit</a>

<form action="{{ route('admin.souvenirs.destroy', $item->id) }}"
      method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
