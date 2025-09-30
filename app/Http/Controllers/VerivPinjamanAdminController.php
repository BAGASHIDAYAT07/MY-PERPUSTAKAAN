<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerivPinjamanAdminController extends Controller
{
    public function veriv(){
        return view('peminjaman.verivikasi', ["active" => "veriv"]);
    }
}
