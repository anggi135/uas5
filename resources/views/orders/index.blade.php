@extends('layouts.landing-page.master')

@section('content')
<div class="container mt-5">
    <h3>Data Pesanan</h3>

    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">
        Buat Pesanan
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach($orders as $no => $order)
        <tr>
            <td>{{ $no+1 }}</td>
            <td>{{ $order->nama_pemesan }}</td>
            <td>Rp {{ number_format($order->total_harga) }}</td>
            <td>{{ $order->status }}</td>
            <td>
                <a href="{{ route('orders.show', $order->id) }}"
                   class="btn btn-info btn-sm">Detail</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
