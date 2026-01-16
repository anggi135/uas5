@extends('layouts.landing-page.master')

@section('title', 'Kategori')

@section('content')
<div class="container mt-5">
    <h3>Data Kategori</h3>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
        Tambah Kategori
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
        @foreach($categories as $no => $item)
        <tr>
            <td>{{ $no + 1 }}</td>
            <td>{{ $item->nama_kategori }}</td>
            <td>
                <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('categories.destroy', $item->id) }}"
                      method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus data?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
