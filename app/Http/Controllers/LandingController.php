<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Bisa tambahkan data statistik, produk unggulan, dsb jika ingin
        return view('landing.index');
    }
}
