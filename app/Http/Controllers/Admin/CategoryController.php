<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    { 
        $categories = Category::all(); 
        return view('admin.categories.index', compact('categories')); 
    }
    
    public function create()
    { 
        return view('admin.categories.create'); 
    }
    
    public function store(Request $r)
    { 
        Category::create($r->validate(['name'=>'required'])); 
        return redirect()->route('admin.categories.index'); 
    }
    
    public function edit(Category $category)
    { 
        return view('admin.categories.edit', compact('category')); 
    }
    
    public function update(Request $r, Category $category)
    { 
        $category->update($r->validate(['name'=>'required'])); 
        return redirect()->route('admin.categories.index'); 
    }
    
    public function destroy(Category $category)
    { 
        $category->delete(); 
        return back(); 
    }
}