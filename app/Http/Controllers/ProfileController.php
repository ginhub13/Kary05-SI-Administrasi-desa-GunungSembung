<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PotensiDesa;

class ProfileController extends Controller
{
    public function index()
    {
        $modelPotensi = new PotensiDesa();
        $dataPotensi = $modelPotensi->latest()->limit(3)->get();
        return view('pages.index', compact('dataPotensi'));
    }

    public function profile()
    {
        return view('pages.profile');
    }

    public function potensiDesa()
    {
        $modelPotensi = new PotensiDesa();
        $data = $modelPotensi->getAllPotensiDesa();
        return view('pages.potensi-desa', compact('data'));
    }

    public function showPotensi($slug)
    {
        $potensi = PotensiDesa::where('slug', $slug)
                          ->where('status_publikasi', 'publish')
                          ->firstOrFail();

        $potensi_lainnya = PotensiDesa::where('id', '!=', $potensi->id)
                                  ->where('status_publikasi', 'publish')
                                  ->inRandomOrder()
                                  ->take(3)
                                  ->get();

        return view('pages.detail-potensi', compact('potensi', 'potensi_lainnya'));
    }


    public function kontak()
    {
        return view('pages.kontak');
    }
}