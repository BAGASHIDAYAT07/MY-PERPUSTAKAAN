<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function create(){
        return view('peminjaman.create');
    }
}
