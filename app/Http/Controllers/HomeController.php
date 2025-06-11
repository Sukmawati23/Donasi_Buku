<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Mengarahkan user ke dashboard sesuai jenis_user
    public function dashboard()
    {
        $user = Auth::user();

        if ($user->jenis_user === 'donatur') {
            return redirect()->route('donatur.dashboard');
        } elseif ($user->jenis_user === 'penerima') {
            return redirect()->route('penerima.dashboard');
        } else {
            // Admin atau lainnya
            return redirect()->route('admin.dashboard');
        }
    }

    public function donaturDashboard()
    {
        return view('dashboard.donatur');
    }

    public function penerimaDashboard()
    {
        return view('dashboard.penerima');
    }

    public function adminDashboard()
    {
        return view('dashboard.admin');
    }
}
