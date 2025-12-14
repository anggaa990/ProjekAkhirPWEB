<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuViewController extends Controller
{
    public function index()
    {
        // Ambil semua kategori untuk filter
        $categories = Category::orderBy('name', 'asc')->get();
        
        // Ambil semua menu dengan relasi category
        $menus = Menu::with('category')
                    ->orderBy('name', 'asc')
                    ->get();
        
        return view('customer.menu', compact('menus', 'categories'));
    }
}