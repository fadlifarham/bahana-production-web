<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::with('user')
            ->whereNotIn('status', [0])
            ->orderBy('status', 'ASC')
            ->get();
        return view('admin.order.index', compact(['orders']));
    }

    public function detail($id) {
        $order = Order::find($id);
        return view('admin.order.detail', compact(['order']));
    }

    public function postConfirm($id, Request $request) {
        $order = Order::find($id);

        $order->status = 3;

        $order->save();

        return redirect(route('adminOrderIndex'));
    }
}
