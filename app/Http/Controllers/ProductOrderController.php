<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ProductOrder;
use App\Order;

class ProductOrderController extends Controller
{
    public function index()
    {
        $order = Order::where('user_id', Auth::user()->id)
            ->where('status', 0)
            ->first();


        if (!$order) {
            $carts = [];
        } else {
            $carts = ProductOrder::where('order_id', $order->id)
                ->with('product')
                ->get();
        }
        
        return view('user.cart.index', compact(['carts']));
    }

    public function post($id, Request $request)
    {
        $order = Order::where('id', $id)->with('productOrders')->first();

        $totalPaid = 0;
        foreach ($order->productOrders as $po) {
            $productOrder = ProductOrder::find($po->id);
            $productOrder->amount = $request['cart-' . $po->id];
            $productOrder->save();

            $totalPaid += $productOrder->amount * $productOrder->price;
        }

        $order->status = 1;
        $order->total_paid = $totalPaid;
        $order->save();
        
        return redirect(route('orderDetail', $order->id));
    }

    public function delete($id, Request $request)
    {
        $order = Order::find($id);

        $order->delete();

        toastr()->success('Berhasil mengosongkan keranjang');
        
        return redirect(route('productIndex'));
    }
}
