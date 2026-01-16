<div class="mb-3">
    <label>Kategori</label>
    <select name="category_id" class="form-control" required>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}"
                @selected(old('category_id', $souvenir->category_id ?? '') == $cat->id)>
                {{ $cat->nama_kategori }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Nama Produk</label>
    <input type="text"
           name="nama_produk"
           class="form-control"
           value="{{ old('nama_produk', $souvenir->nama_produk ?? '') }}"
           required>
</div>

<div class="mb-3">
    <label>Harga</label>
    <input type="number"
           name="harga"
           class="form-control"
           value="{{ old('harga', $souvenir->harga ?? '') }}"
           required>
</div>

<div class="mb-3">
    <label>Stok</label>
    <input type="number"
           name="stok"
           class="form-control"
           value="{{ old('stok', $souvenir->stok ?? 0) }}"
           required>
</div>

<div class="mb-3">
    <label>Gambar</label>
    <input type="file" name="gambar" class="form-control">
</div>
