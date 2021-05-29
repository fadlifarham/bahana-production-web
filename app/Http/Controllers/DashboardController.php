<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\User;
use App\Product;

class DashboardController extends Controller
{
    public function index() {
        if (Auth::user()->role_id == 2) return redirect(route('productIndex'));

        $totalOrder = Order::all();
        $totalUser = User::all();
        $totalProduct = Product::all();
        $totalOrderNeedConfirm = Order::where('status', 2)->get();

        return view('admin.dashboard', compact(['totalOrder', 'totalUser', 'totalProduct', 'totalOrderNeedConfirm']));
    }
}
