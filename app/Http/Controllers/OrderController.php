<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();
        try {
            $order = Order::create(['user_id'=>auth()->id(),'status'=>'pending']);
            $total = 0;
            foreach($data['items'] as $it){
                $menu = Menu::lockForUpdate()->find($it['menu_id']);
                if(!$menu || $menu->stock < $it['quantity']){ DB::rollBack(); return response()->json(['error'=>'Stok tidak cukup untuk ' . ($menu->name ?? '')],422); }
                $menu->stock -= $it['quantity']; $menu->save();
                $order->items()->create(['menu_id'=>$menu->id,'quantity'=>$it['quantity'],'price'=>$menu->price]);
                $total += $menu->price * $it['quantity'];
            }
            $order->total = $total; $order->save();
            DB::commit();
            return response()->json($order->load('items.menu'));
        } catch(\Exception $e){ DB::rollBack(); throw $e; }
    }
}
