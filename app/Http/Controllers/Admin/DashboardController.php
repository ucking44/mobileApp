<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Manufacture;
use App\Product;

class DashboardController extends Controller
{
    // public function dashboard()
    // {
    //     return view('admin.dashboard');
    // }

    public function index()
    {
        $categoryCount = Category::count();
        $manufactureCount = Manufacture::count();
        $productCount = Product::count();
        // $itemCount = Item::count();
        // $sliderCount = Slider::count();
        // $reservations = Reservation::where('status', false)->get();
        // $contactCount = Contact::count();
        return view('admin.dashboard', compact('categoryCount', 'manufactureCount', 'productCount'));
    }

}
