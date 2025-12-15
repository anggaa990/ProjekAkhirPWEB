<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    { 
        $menus = Menu::with('category')->get(); 
        return view('admin.menus.index', compact('menus')); 
    }
    
    public function create()
    { 
        $categories = Category::all();
        return view('admin.menus.create', compact('categories')); 
    }
    
    public function store(Request $r)
    { 
        $validated = $r->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
            'is_available' => 'nullable|boolean'
        ]);
        
        // Set is_available default true jika checkbox tidak dicentang
        $validated['is_available'] = $r->has('is_available') ? true : false;
        
        // Handle image upload jika ada
        if ($r->hasFile('image')) {
            $validated['image'] = $r->file('image')->store('menus', 'public');
        }
        
        Menu::create($validated);
        
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan!');
    }
    
    public function edit(Menu $menu)
    { 
        $categories = Category::all();
        return view('admin.menus.edit', compact('menu','categories')); 
    }
    
    public function update(Request $r, Menu $menu)
    { 
        $validated = $r->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
            'is_available' => 'nullable|boolean'
        ]);
        
        // Set is_available
        $validated['is_available'] = $r->has('is_available') ? true : false;
        
        // Handle image upload jika ada
        if ($r->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($menu->image) {
                \Storage::disk('public')->delete($menu->image);
            }
            $validated['image'] = $r->file('image')->store('menus', 'public');
        }
        
        $menu->update($validated);
        
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diupdate!');
    }
    
    public function destroy(Menu $menu)
    { 
        // Hapus gambar jika ada
        if ($menu->image) {
            \Storage::disk('public')->delete($menu->image);
        }
        
        $menu->delete();
        
        return back()->with('success', 'Menu berhasil dihapus!');
    }
}