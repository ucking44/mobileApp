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
        $data['options']['image'] = $product_info->product_image;

        $dataC = Cart::add($data);
        //return response()->json($dataC, 201);
        return response([
            'success' => $dataC,
            'Product' => 'Item Added To Cart Successfully!',
        ]);

    }

    public function show_cart()
    {
        $all_published_category = DB::table('category')
                                  ->where('publication_status', 1)
                                  ->get();

        return response([
            'success' => $all_published_category,
            'category' => 'Showing All Category Successfully!',
        ]);

    }

    public function delete_to_cart($rowId)
    {
        $deleteC = Cart::update($rowId, 0);

        return response([
            'success' => $deleteC,
            'product' => 'Item Deleted Successfully!!!',
        ]);

        //return Redirect::to('/show-cart');
        //Cart::destroy();
    }

    public function update_cart(Request $request)
    {
        $qty = $request->qty;
        $rowId = $request->rowId;
        //dd($rowId);
        $updateC = Cart::update($rowId, $qty);
        return response([
            'success' => $updateC,
            'product' => 'Item Updated Successfully!!!',
        ]);

        //return Redirect::to('/show-cart');
        //Cart::destroy();
    }


}

