@extends('layouts.landing-page.master')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container py-5">

    <h3 class="mb-4">Detail Pesanan</h3>

    <div class="card">
        <div class="card-body">

            <p>Status:
                <strong>{{ ucfirst($order->status) }}</strong>
            </p>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->souvenir->nama_produk }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp {{ number_format($item->harga) }}</td>
                        <td>
                            Rp {{ number_format($item->harga * $item->qty) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h5 class="text-end">
    Total:
    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
</h5>


        </div>
    </div>

</div>
@endsection
