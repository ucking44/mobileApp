<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\Review;
use App\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

//use Illuminate\Support\Facades\Redirect;
//use App\Http\Requests;
//use Session;
session_start();

class HomeController extends Controller
{
    public function index()
    {
        $all_published_product = DB::table('products')
                   ->join('categories', 'products.category_id', '=', 'categories.category_id')
                   ->join('manufactures', 'products.manufacture_id', '=', 'manufactures.manufacture_id')
                   ->select('products.*', 'categories.category_name', 'manufactures.manufacture_name')
                   ->where('products.status', 'enable')
                   ->limit(9)
                   ->get();
        //return view('pages.home_content', compact('all_published_product'));

        return response()->json([
            'success' => true,
            'data' => $all_published_product,
            'message' => 'All Successfully Published Products !!!',
        ], 200);

    }

    public function show_product_by_category($category_id)
    {
        $product_by_category = DB::table('products')
                   ->join('categories', 'products.category_id', '=', 'categories.category_id')
                   //->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
                   ->select('products.*', 'categories.category_name')
                   ->where('categories.category_id', $category_id)
                   ->where('products.status', 'enable')
                   ->limit(10)
                   ->get();
        //return view('pages.category_by_products', compact('product_by_category'));
        return response()->json([
            'success' => true,
            'data' => $product_by_category,
            'message' => 'All Successfully Published Product Category !!!',
        ], 200);

    }

    public function show_product_by_manufacture($manufacture_id)
    {
        $product_by_manufacture = DB::table('products')
                   ->join('categories', 'products.category_id', '=', 'categories.category_id')
                   ->join('manufactures', 'products.manufacture_id', '=', 'manufactures.manufacture_id')
                   ->select('products.*', 'categories.category_name', 'manufactures.manufacture_name')
                   ->where('manufactures.manufacture_id', $manufacture_id)
                   ->where('products.status', 'enable')
                   ->limit(18)
                   ->get();
        //return view('pages.manufacture_by_products', compact('product_by_manufacture'));
        return response()->json([
            'success' => true,
            'data' => $product_by_manufacture,
            'message' => 'All Successfully Published Product Manufacture !!!',
        ], 200);

    }

    public function product_details_by_id($product_id)
    {
        $product_by_details = DB::table('products')
                   ->join('categories', 'products.category_id', '=', 'categories.category_id')
                   ->join('manufactures', 'products.manufacture_id', '=', 'manufactures.manufacture_id')
                   ->select('products.*', 'categories.category_name', 'manufactures.manufacture_name')
                   ->where('products.product_id', $product_id)
                   ->where('products.status', 'enable')
                   ->first();

                   //->limit(18)
                   //->get();
        //return view('pages.product_details', compact('product_by_details'));
        return response()->json([
            'success' => true,
            'data' => $product_by_details,
            'message' => 'Products By Details !!!',
        ], 200);

    }

    public function productReview($product_id)
    {
       $product = Product::findOrFail($product_id);
       $review = Review::all()->where('product_id', $product_id);
       //return view('pages.reviews.show', compact('product', 'review'));
       return response()->json([
            'success' => true,
            'data' => $product, $review,
            'message' => 'Product Review !!!',
        ], 200);

    }

    public function wishList(Request $request)
    {
        // $this->validate($request, [
        //     'customer_name' => 'required',
        // ]);
        // $customer_name = $request->customer_name;
        // $customer_id = $request->customer_id;
        // $customer_id = DB::table('customer')
        //                         ->where('customer_name', $customer_name)
        //                         ->where('customer_id', $customer_id)
        //                         ->get();

        $wishList = new WishList();
        $wishList->customer_id = Session::get('customer_id');
        $wishList->product_id = $request->product_id;
        // $wishList->customer()->associate($customer_id);
        $wishList->save();

        //return redirect()->back()->with('success', 'Product Added To WishList');
        return response()->json([
            'success' => true,
            //'data' => $product_by_details,
            'message' => 'Wish List Saved Successfully !!!',
        ], 200);

    //    $products = DB::table('products')->where('product_id', $request->product_id)->get();
    //    return view('pages.product_details', compact('products'));

    }

    public function view_wishList()
    {
        $products = DB::table('wish_lists')->leftJoin('products', 'wish_lists.product_id', '=', 'products.product_id')->get();
        //return view('pages.wishList', compact('products'));
        return response()->json([
            'success' => true,
            'data' => $products,
            'message' => 'View Wish List !!!',
        ], 200);

    }

    public function removeWishList($id)
    {
        DB::table('wish_lists')->where('product_id', '=', $id)->delete();
        //return back()->with('success', 'Product Removed From WishList');
        return response()->json([
            'success' => true,
            // 'data' => $product_by_details,
            'message' => 'Products By Details !!!',
        ], 200);
    }

}


