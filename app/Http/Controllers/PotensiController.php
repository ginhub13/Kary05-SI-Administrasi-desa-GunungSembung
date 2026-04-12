<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PotensiController extends Controller
{
    public function index()
    {
        return view('admin.potensi.index');
    }

    public function create()
    {
        return view('admin.potensi.create');
    }
}