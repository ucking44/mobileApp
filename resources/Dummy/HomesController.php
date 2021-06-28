<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Redirect;
//use App\Http\Requests;
use Session;
//session_start();

class HomesController extends Controller
{
    public function index()
    {
        $all_published_product = DB::table('products')
                   ->join('category', 'products.category_id', '=', 'category.category_id')
                   ->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
                   ->select('products.*', 'category.category_name', 'manufacture.manufacture_name')
                   ->where('products.publication_status', 1)
                   ->limit(9)
                   //->paginate(2);
                   ->get();

        return response()->json([
            'success' => true,
            'data' => $all_published_product
        ], 200);

    }

    public function show_product_by_category($category_id)
    {
        $product_by_category = DB::table('products')
                   ->join('category', 'products.category_id', '=', 'category.category_id')
                   //->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
                   ->select('products.*', 'category.category_name')
                   ->where('category.category_id', $category_id)
                   ->where('products.publication_status', 1)
                   ->limit(10)
                   //->paginate(2);
                   ->get();

        return response()->json([
            'success' => true,
            'data' => $product_by_category
        ], 200);

    }

    public function show_product_by_manufacture($manufacture_id)
    {
        $product_by_manufacture = DB::table('products')
                   ->join('category', 'products.category_id', '=', 'category.category_id')
                   ->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
                   ->select('products.*', 'category.category_name', 'manufacture.manufacture_name')
                   ->where('manufacture.manufacture_id', $manufacture_id)
                   ->where('products.publication_status', 1)
                   ->limit(18)
                   ->get();

        return response()->json([
            'success' => true,
            'data' => $product_by_manufacture,
        ], 200);

    }

    public function product_details_by_id($product_id)
    {
        $product_by_details = DB::table('products')
                   ->join('category', 'products.category_id', '=', 'category.category_id')
                   ->join('manufacture', 'products.manufacture_id', '=', 'manufacture.manufacture_id')
                   ->select('products.*', 'category.category_name', 'manufacture.manufacture_name')
                   ->where('products.product_id', $product_id)
                   ->where('products.publication_status', 1)
                   ->first();
                   //->limit(18)
                   //->get();

        return response()->json([
            'success' => true,
            'data' => $product_by_details,
        ], 200);

    }

}
