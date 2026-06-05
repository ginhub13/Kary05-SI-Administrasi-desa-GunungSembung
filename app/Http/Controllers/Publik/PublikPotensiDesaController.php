<?php

namespace App\Http\Controllers\Publik;
use App\Http\Controllers\Controller;

use App\Models\PotensiDesa;

class PublikPotensiDesaController extends Controller
{
    public function potensiDesa()
    {
        $modelPotensi = new PotensiDesa();
        $data = $modelPotensi->getAllPotensiDesa();
        return view('pages.potensi-desa', compact('data'));
    }
}