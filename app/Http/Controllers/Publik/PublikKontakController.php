<?php

namespace App\Http\Controllers\Publik;
use App\Http\Controllers\Controller;

class PublikKontakController extends Controller
{
        public function kontak()
        {
            return view('pages.kontak');
        }
}



