<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $carts = Cart::with("product")->get();
        return view("home")->with(compact(['products', 'carts']));
    }

    public function add_cart(Request $req)
    {
        $cart = new Cart();
        $cart->product_id = $req->id;
        $cart->quantity = 1;
        $cart->save();

        $product = Product::find($req->id);
        $product->checked = 1;
        $product->save();
        return response()->json(["status" => "SUCCESS"]);
    }

    public function delete_cart(Request $req)
    {
        $cart = Cart::find($req->id);
        $product = Product::find($cart->product_id);
        $product->checked = 0;
        $product->save();
        $cart->delete();

        return response()->json(["status" => "SUCCESS"]);
    }

    public function update_cart(Request $req)
    {
        $cart = Cart::find($req->id);
        if ($req->type === "ADD") {
            $cart->increment('quantity');
            $cart->save();
        }

        if ($req->type === "SUB") {
            $quantity = $cart->quantity;
            if ($quantity - 1 === 0) {
                $product = Product::find($cart->product_id);
                $product->checked = 0;
                $product->save();
                $cart->delete();
            } else {
                $cart->decrement('quantity');
                $cart->save();
            }
        }
        return response()->json(["status" => "SUCCESS"]);
    }
}
