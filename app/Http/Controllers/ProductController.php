<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use JWTAuth;
//use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Manufacture;
use App\Review;
use Carbon\Carbon;
use Session;
session_start();

class ProductController extends Controller
{
    protected $user;

    /**
     * The attributes that is for user authentication
     *
     *
     */
    // public function __construct()
    // {
    //     $this->user = JWTAuth::parseToken()->authenticate();
    // }

    public function __construct()
    {
        //$this->middleware('auth.role:admin');
        //$this->middleware('auth.role:admin', ['except' => ['index']]);
    }

    /**
     * The attributes that is for all products
     *
     *
     */
    public function all_product()
    {
        // $categories = Category::all();
        // $all_manufacture_info = Manufacture::all();
        // $products = Product::paginate(5);
        // return view('admin.product.index', compact('categories', 'all_manufacture_info', 'products'));

        $products = DB::table('products')
                    ->join('categories', 'products.category_id', '=', 'categories.category_id')
                    ->join('manufactures', 'products.manufacture_id', '=', 'manufactures.manufacture_id')
                    ->select('products.*', 'categories.category_name', 'manufactures.manufacture_name')
                    //->orderBy('product_id', 'asc')
                    ->oldest()
                    //->latest()
                    ->paginate(4);
        return view('admin.product.index', compact('products'));
    }

    public function index()
    {
        return $this->user = DB::table('products')
                   ->join('categories', 'products.category_id', '=', 'categories.category_id')
                   ->join('manufactures', 'products.manufacture_id', '=', 'manufactures.manufacture_id')
                   ->select('products.*', 'categories.category_name', 'manufactures.manufacture_name')
                   ->paginate(4);
                   //->toArray();
                   //->get();
        // return response()->json([
        //     'success' => true,
        //     'data' => $all_published_product,
        //     'message' => 'All Successfully Published Products !!!',
        // ], 200);
    }

    public function product_create()
    {
        $products = Product::all();
        //$categories = Category::all();
        $categories = Category::pluck('category_name', 'category_id');
        $all_manufacture_info = Manufacture::all();
        return view('admin.product.create', compact('products', 'categories', 'all_manufacture_info'));
    }

    public function show($product_id)
    {
        $show_product = Product::findOrFail($product_id);
        return view('admin.product.show', compact('show_product'));
    }

    public function showReview($id)
    {
        $product = Product::findOrFail($id);
        $review = Review::all()->where('product_id', $id);
        //return view('pages.showReview.show', compact('product', 'review'));
        return response()->json([
            'success' => true,
            'data' => $product, $review,
        ], 200);
    }

    public function show_product_by_id($product_id)
    {
        $product = Product::findOrFail($product_id);
        return response()->json($product, 200);
    }

    // public function show(Product $product)
    // {
    //     $product->load(['reviews' => function ($query) {
    //         $query->latest();
    //     }, 'user']);
    //     return response()->json(['product' => $product]);
    // }

    public function save_product(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'manufacture' => 'required',
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required | numeric',
            'stock' => 'required',
            'product_image' => 'required | file',
        ]);

        $image = $request->file('product_image');
        $slug = str_slug($request->name);

        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('uploads/products'))
            {
                mkdir('uploads/products', 0777, true);
            }
            $image->move('uploads/products', $imagename);
        }
        else {
            $imagename = 'default.png';
        }

        $data = new Product();
        $data->product_name = $request->product_name;
        $data->category_id = $request->category;
        $data->manufacture_id = $request->manufacture;
        $data->product_description = $request->product_description;
        $data->product_price = $request->product_price;
        $data->stock = $request->stock;
        $data->product_size = $request->product_size;
        $data->product_color = $request->product_color;
        $data->product_image = $imagename;

        if(isset($request->status))
        {
            $data->status = 'enable';
        } else {
            $data->status = 'disable';
        }
        $data->save();
        return Redirect::to('/all-product')->with('successMsg', 'Product Saved Successfully ):');
    }

    public function edit($product_id)
    {
        $product_info = Product::findOrFail($product_id);
        $categories = Category::all();
        $all_manufacture_info = Manufacture::all();
        return view('admin.product.edit', compact('product_info', 'categories', 'all_manufacture_info'));
    }

    public function update_product(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);
        $product->category_id = $request->category;
        $product->manufacture_id = $request->manufacture;
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_price;
        $product->stock = $request->stock;
        $product->product_size = $request->product_size;
        $product->product_color = $request->product_color;
        $product->status = $request->status;
        if(isset($request->status))
        {
            $product->status = 'enable';
        } else {
            $product->status = 'disable';
        }
        $product->save();
        return Redirect::to('/all-product')->with('successMsg', 'Product Updated Successfully ):');
    }

    public function delete_product($product_id)
    {
        $deleteP = Product::findOrFail($product_id);
        $deleteP->delete();
        return Redirect::to('/all-product')->with('successMsg', 'Product Deleted Successfully ):');
    }

    public function unactive_product($product_id)
    {
        $unactive_product = Product::findOrFail($product_id);
        $unactive_product->update(['status' => 'disable']);
        return Redirect::to('/all-product')->with('successMsg', 'Product Un-activated Successfully ):');
    }

    public function active_product($product_id)
    {
        $active_product = Product::findOrFail($product_id);
        $active_product->update(['status' => 'enable']);
        return Redirect::to('/all-product')->with('successMsg', 'Product Activated Successfully ):');
    }

    public function search(Request $request)
    {
        $data = Product::where('product_name', 'like', '%' . $request->input('query') . '%')
                        ->join('categories', 'products.category_id', '=', 'categories.category_id')
                        ->join('manufactures', 'products.manufacture_id', '=', 'manufactures.manufacture_id')
                        ->simplePaginate(2);
                        // ->select('products.*', 'categories.category_name', 'manufactures.manufacture_name')
                        //->get();
        //return view('pages.search', ['products' => $data]);
        //return $data;

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);

    }
}


