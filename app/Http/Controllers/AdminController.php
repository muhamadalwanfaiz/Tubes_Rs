<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }

    public function pasiens()
    {
        $user = Auth::user();
        $pasiens = Pasien::all();
        return view('pasien',compact('user','pasiens'));
    }

    public function dokters()
    {
        $user = Auth::user();
        $dokters = Dokter::all();
        return view('dokter',compact('user','dokters'));
    }

}
