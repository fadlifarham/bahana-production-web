<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::get();
        return view('admin.product.index', compact(['products']));
    }

    public function create () {
        return view('admin.product.create');
    }

    public function store (Request $request) {
        $file = $request->file('image');
        $nama_file = time()."_".$file->getClientOriginalName();

        $file->move('uploads/product', $nama_file);
        $photo = 'uploads/product/' . $nama_file;

        $product = Product::create([
            'name'              => $request->name,
            'price'             => (int) str_replace(",", "", $request->price),
            'stock'             => $request->stock,
            'image'             => $photo,
            'description'       => "-",
            'product_type_id'   => 1
        ]);

        return redirect()->route('adminProductIndex');
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return view('admin.product.edit', compact(['product']));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if ($request->file('image')) {
            $file = $request->file('photo');
            $nama_file = time()."_".$file->getClientOriginalName();

            $file->move('uploads/product', $nama_file);
            $photo = 'uploads/product/' . $nama_file;
        } else {
            $photo = $product->photo;
        }

        $product->update([
            'name'      => $request->name,
            'price'     => (int) str_replace(",", "", $request->price),
            'stock'     => $request->stock,
            'photo'     => $photo
        ]);

        $product->save();

        return redirect()->route('adminProductIndex');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->route('adminProductIndex');
    }

}
