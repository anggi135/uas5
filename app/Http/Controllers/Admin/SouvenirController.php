<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Souvenir;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SouvenirController extends Controller
{
    /**
     * LIST DATA SOUVENIR (ADMIN)
     */
    public function index()
    {
        $souvenirs = Souvenir::with('category')->latest()->paginate(10);
        return view('admin.souvenirs.index', compact('souvenirs'));
    }

    /**
     * FORM TAMBAH SOUVENIR
     */
    public function create()
    {
        $categories = Category::orderBy('nama_kategori')->get();
        return view('admin.souvenirs.create', compact('categories'));
    }

    /**
     * SIMPAN DATA
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('souvenirs', 'public');
        }

        Souvenir::create($data);

        return redirect()
            ->route('admin.souvenirs.index')
            ->with('success', 'Souvenir berhasil ditambahkan');
    }

    /**
     * FORM EDIT
     */
    public function edit(Souvenir $souvenir)
    {
        $categories = Category::orderBy('nama_kategori')->get();
        return view('admin.souvenirs.edit', compact('souvenir', 'categories'));
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, Souvenir $souvenir)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($souvenir->gambar) {
                Storage::disk('public')->delete($souvenir->gambar);
            }

            $data['gambar'] = $request->file('gambar')
                ->store('souvenirs', 'public');
        }

        $souvenir->update($data);

        return redirect()
            ->route('admin.souvenirs.index')
            ->with('success', 'Souvenir berhasil diupdate');
    }

    /**
     * HAPUS DATA
     */
    public function destroy(Souvenir $souvenir)
    {
        if ($souvenir->gambar) {
            Storage::disk('public')->delete($souvenir->gambar);
        }

        $souvenir->delete();

        return redirect()
            ->route('admin.souvenirs.index')
            ->with('success', 'Souvenir berhasil dihapus');
    }
}
