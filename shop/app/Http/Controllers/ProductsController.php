<?php

namespace App\Http\Controllers;
use App\Models\Products;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {
        $products = Products::all();
        return($products);
    }


    public function create(Request $request) {
        $data = array(
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $request->image,
            'status' => $request->status
        );
        return Products::create($data);
    }

    public function delete($id) {
        $product = Products::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Product deleted'], 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function update($id) {
        $product = Products::find($id);
        if ($product) {
            $product->update();
            return response()->json(['message' => 'Product deleted'], 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function addToCart($id)
{
$product = Products::findOrFail($id);
$cart = session()->get('cart', []);
  
if(isset($cart[$id])) {
$cart[$id]['quantity']++;
} else {
$cart[$id] = [
"name" => $product->name,
"quantity" => 1,
"price" => $product->price,
"image" => $product->image
];
}
          
session()->put('cart', $cart);
return redirect()->back()->with('success', 'Product added to cart successfully!');
}
}
