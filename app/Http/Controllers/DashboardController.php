<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $annonces = Annonce::with('images')->where('user_id', '!=', Auth::id())
        ->latest()->paginate(9);
        return view('dashboard', compact('annonces'));
    }
}

