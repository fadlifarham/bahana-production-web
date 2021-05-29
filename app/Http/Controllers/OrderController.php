<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\ProductOrder;
use Auth;

class OrderController extends Controller
{
    public function index() {
        // WAJIB
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

        $orders = Order::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->with('productOrders.product')
            ->get();

        return view('user.order.index', compact(['orders', 'carts']));
    }

    public function detail($id)
    {
        // WAJIB
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

        $order = Order::where('id', $id)
            ->first();
        return view('user.order.detail', compact(['order', 'carts']));
    }

    public function proofOfPayment($id, Request $request)
    {
        $order = Order::find($id);

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('img'), $imageName);

        $order->proof_of_payment = "img/" . $imageName;
        $order->status = 2;

        $order->save();

        return redirect(route('orderIndex'));
    }
}
