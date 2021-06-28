<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cart;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $qty = $request->qty;
        $product_id = $request->product_id;
        $product_info = DB::table('products')
                        ->where('product_id', $product_id)
                        ->first();

        $data['qty'] = $qty;
        $data['id'] = $product_info->product_id;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['stock'] = $product_info->stock;
        $data['options']['image'] = $product_info->product_image;

        Cart::add($data);
        return back();
        //return Redirect::to('/show-cart');
    }

    public function show_cart()
    {
        $all_published_category = DB::table('categories')
                                  ->where('status', 'enable')
                                  ->get();

        return view('pages.add_to_cart', compact('all_published_category'));
    }

    public function delete_to_cart($rowId)
    {
        Cart::update($rowId, 0);
        return Redirect::to('/show-cart');
        //Cart::destroy();
    }

    public function update_cart(Request $request)
    {
        $qty = $request->qty;
        $rowId = $request->rowId;
        //dd($rowId);
         Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');
        //Cart::destroy();
    }


}

