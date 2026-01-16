<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Testimonial;
use App\Models\AppSetting;

class HomeController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->latest()->get();
        $testimonial = Testimonial::latest()->get();

        // fallback agar tidak null
        $appSetting = AppSetting::first() ?? (object)[
            'nama_mitra'   => 'Baby Souvenir',
            'kontak_admin' => '08xxxxxxxxxx',
            'tentang'      => 'Kami adalah supplier souvenir terpercaya untuk berbagai acara spesial.'
        ];

        return view('home.index', compact(
            'produks',
            'testimonial',
            'appSetting'
        ));
    }
}
