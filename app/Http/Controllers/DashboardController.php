<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $recentProducts = Product::latest()->take(5)->get();
        return view('dashboard', compact('recentProducts'));
    }
}
