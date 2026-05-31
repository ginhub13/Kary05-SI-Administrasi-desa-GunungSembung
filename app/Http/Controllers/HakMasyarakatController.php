<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HakMasyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HakMasyarakatController extends Controller
{
    public function index()
    {
        return view('pages.hak-masarakat');
    }
}