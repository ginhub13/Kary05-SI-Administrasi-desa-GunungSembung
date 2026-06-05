<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;

class HakMasyarakatController extends Controller
{
    public function index()
    {
        return view('pages.hak-masarakat');
    }
}