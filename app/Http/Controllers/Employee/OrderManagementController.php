<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.menu'])->latest()->get();
        return view('employee.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.menu', 'reservation']);
        return view('employee.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cooking,ready,completed,cancelled',
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        // Update status order
        $order->update(['status' => $newStatus]);

        // ✅ OTOMATIS KURANGI STOK saat status jadi 'completed'
        if ($newStatus == 'completed' && $oldStatus != 'completed') {
            foreach ($order->items as $item) {
                $menu = Menu::find($item->menu_id);
                if ($menu) {
                    // Kurangi stok sesuai quantity yang dipesan
                    $newStock = $menu->stock - $item->quantity;
                    
                    // Pastikan stok tidak negatif
                    if ($newStock < 0) {
                        $newStock = 0;
                    }
                    
                    $menu->update(['stock' => $newStock]);
                    
                    // Jika stok habis, set menu jadi tidak tersedia
                    if ($newStock == 0) {
                        $menu->update(['is_available' => false]);
                    }
                }
            }
        }

        // ✅ KEMBALIKAN STOK jika order di-cancel (jika sebelumnya completed)
        if ($newStatus == 'cancelled' && $oldStatus == 'completed') {
            foreach ($order->items as $item) {
                $menu = Menu::find($item->menu_id);
                if ($menu) {
                    $newStock = $menu->stock + $item->quantity;
                    $menu->update([
                        'stock' => $newStock,
                        'is_available' => true
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Status pesanan berhasil diupdate!');
    }
}