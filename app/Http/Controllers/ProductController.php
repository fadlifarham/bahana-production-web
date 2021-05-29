<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\ProductOrder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        $products = Product::get();
        return view('user.product.index', compact(['products', 'carts']));
    }

    public function order($id)
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

        $product = Product::find($id);
        return view('user.product.order', compact(['product', 'carts']));
    }

    public function postOrder($id, Request $request)
    {
        $product = Product::find($id);

        // TODO: Validator

        $order = Order::where('user_id', Auth::user()->id)
            ->where('status', 0)
            ->first();
        
        if (!$order) {
            $order = Order::create([
                'user_id'           => Auth::user()->id,
                'status'            => 0,
                'amount'            => 1,
                'total_paid'        => 1 * $product->price
            ]);
        }

        $productOrder = ProductOrder::where('product_id', $product->id)
            ->where('order_id', $order->id)
            ->first();
        
        if (!$productOrder) {
            $productOrder = ProductOrder::create([
                'order_id'          => $order->id,
                'product_id'        => $product->id,
                'amount'            => 1,
                'price'             => $product->price
            ]);
        } else {
            $productOrder->amount = $productOrder->amount + 1;
            $productOrder->save();
        }

        toastr()->success($product->name . " telah ditambahkan ke keranjang");

        return redirect()->back();
    }
}
