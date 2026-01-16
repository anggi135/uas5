<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Souvenir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * LIST ORDER USER
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * FORM CHECKOUT (1 PRODUK)
     * /orders/create?souvenir_id=1
     */
    public function create(Request $request)
    {
        abort_if(!$request->souvenir_id, 404);

        $souvenir = Souvenir::findOrFail($request->souvenir_id);

        // Pastikan stok tersedia
        if ($souvenir->stok <= 0) {
            return redirect()
                ->route('souvenirs.index')
                ->with('error', 'Produk sedang habis');
        }

        return view('orders.create', compact('souvenir'));
    }

    /**
     * SIMPAN ORDER
     */
    public function store(Request $request)
    {
        $request->validate([
            'souvenir_id' => 'required|exists:souvenirs,id',
            'qty'         => 'required|integer|min:1',
        ]);

        $souvenir = Souvenir::findOrFail($request->souvenir_id);

        // VALIDASI STOK
        if ($request->qty > $souvenir->stok) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        DB::beginTransaction();

        try {
            // HITUNG SUBTOTAL
            $subtotal = $souvenir->harga * $request->qty;

            // CREATE ORDER
            $order = Order::create([
                'user_id'     => Auth::id(),
                'total_harga' => 0, // akan diupdate setelah item dibuat
                'status'      => 'pending',
            ]);

            // CREATE ORDER ITEM
            OrderItem::create([
                'order_id'    => $order->id,
                'souvenir_id' => $souvenir->id,
                'qty'         => $request->qty,
                'harga'       => $souvenir->harga,
                'subtotal'    => $subtotal,
            ]);

            // UPDATE TOTAL ORDER (AMAN & JELAS)
            $order->update([
                'total_harga' => $order->items()->sum('subtotal'),
            ]);

            // KURANGI STOK
            $souvenir->decrement('stok', $request->qty);

            DB::commit();

            return redirect()
                ->route('orders.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat');

        } catch (\Throwable $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan saat membuat pesanan');
        }
    }

    /**
     * DETAIL ORDER
     */
    public function show(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);

        $order->load('items.souvenir');

        return view('orders.show', compact('order'));
    }
}
