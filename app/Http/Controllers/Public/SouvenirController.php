<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Souvenir;
use App\Models\Category;
use Illuminate\Http\Request;

class SouvenirController extends Controller
{
    /**
     * LIST PRODUK (Landing / Katalog)
     * - Bisa search
     * - Bisa filter kategori
     */
    public function index(Request $request)
    {
        $query = Souvenir::with('category')
            ->where('stok', '>', 0);

        // SEARCH
        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        // FILTER KATEGORI
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $souvenirs = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::orderBy('nama_kategori')->get();

        return view('public.souvenirs.index', compact('souvenirs', 'categories'));
    }

    /**
     * DETAIL PRODUK
     */
    public function show(Souvenir $souvenir)
    {
        return view('public.souvenirs.show', compact('souvenir'));
    }
}
