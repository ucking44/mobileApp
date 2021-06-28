<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use App\Http\Requests;
//use Session;
use Cart;

session_start();

class CheckoutController extends Controller
{
    public function login_check()
    {
        return view('pages.login');
    }

    public function customer_registration(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['password'] = md5($request->password);
        $data['mobile_number'] = $request->mobile_number;
        $data['created_at'] = Carbon::now(); //->toDateString();
        $data['updated_at'] = Carbon::now(); //->toDateString();

        $customer_id = DB::table('customer')
                       ->insertGetId($data);

                Session::put('customer_id', $customer_id);
                Session::put('customer_name', $request->customer_name);
                return Redirect('/checkout');
    }

    public function checkout()
    {
        // $all_published_category = DB::table('category')
        //                           ->where('publication_status', 1)
        //                           ->get();
        // return view('pages.checkout', compact('all_published_category'));

        return view('pages.checkout');
    }

    public function save_shipping_details(Request $request)
    {
        $data = array();
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_first_name'] = $request->shipping_first_name;
        $data['shipping_last_name'] = $request->shipping_last_name;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_mobile_number'] = $request->shipping_mobile_number;
        $data['shipping_city'] = $request->shipping_city;
        $data['created_at'] = Carbon::now(); //->toDateString();
        $data['updated_at'] = Carbon::now(); //->toDateString();

        $shipping_id = DB::table('shipping')
                       ->insertGetId($data);
            Session::put('shipping_id', $shipping_id);
            return Redirect::to('/payment');
    }

    public function customer_login(Request $request)
    {
        $customer_email = $request->customer_email;
        $password = md5($request->password);
        $result = DB::table('customer')
                  ->where('customer_email', $customer_email)
                  ->where('password', $password)
                  ->first();

            if ($result) {
                Session::put('customer_id', $result->customer_id, 'customer_name', $result->customer_name);
                //Session::put('customer_name', $result->customer_name);
                return Redirect::to('/checkout');
            }
            else {
                return Redirect::to('/login-check');
            }
    }

    public function payment()
    {
        return view('pages.payment');
    }

    public function order_place(Request $request)
    {
        $payment_gateway = $request->payment_method;

        $paymentData = array();
        $paymentData['payment_method'] = $payment_gateway;
        $paymentData['payment_status'] = 'pending';
        $paymentData['created_at'] = Carbon::now(); //->toDateString();
        $paymentData['updated_at'] = Carbon::now(); //->toDateString();
        $payment_id = DB::table('payment')
                      ->insertGetId($paymentData);

        $orderData = array();
        $orderData['customer_id'] = Session::get('customer_id');
        $orderData['shipping_id'] = Session::get('shipping_id');
        $orderData['payment_id'] = $payment_id;
        $orderData['order_total'] = Cart::total();
        $orderData['order_status'] = 'pending';
        $orderData['created_at'] = Carbon::now(); //->toDateTimeString();
        $orderData['updated_at'] = Carbon::now(); //->toDateString();
        $order_id = DB::table('order')
                    ->insertGetId($orderData);

        $contents = Cart::content();
        $orderData = array();

        foreach ($contents as $v_content)
        {
            $odData['order_id'] = $order_id;
            $odData['product_id'] = $v_content->id;
            $odData['tax'] = Cart::tax();
            $odData['total'] = Cart::total();
            $odData['product_name'] = $v_content->name;
            $odData['product_price'] = $v_content->price;
            $odData['product_sales_quantity'] = $v_content->qty;
            $odData['created_at'] = Carbon::now()->toDateTimeString();
            $odData['updated_at'] = Carbon::now()->toDateTimeString();

            DB::table('order_details')
                ->insert($odData);
        }

        if ($payment_gateway == 'handcash') {
            Cart::destroy();
            return view('pages.handcash');
            // Cart::destroy();
        }

        elseif ($payment_gateway == 'card') {
            echo "Successfully Done By Card";
        }

        elseif ($payment_gateway == 'paypal') {
            echo "Successfully Done By Paypal";
        }

        else {
            echo "No Payment Method Selected";
        }

    }

    public function manage_order()
    {
        $all_order_info = DB::table('order')
                   ->join('customer', 'order.customer_id', '=', 'customer.customer_id')
                   ->select('order.*', 'customer.customer_name')
                   ->get();

        return view('admin.manage_order', compact('all_order_info'));
    }

    public function view_order($order_id)
    {
        $order_by_id = DB::table('order')
                   ->join('customer', 'order.customer_id', '=', 'customer.customer_id')
                   ->join('order_details', 'order.order_id', '=', 'order_details.order_id')
                   ->join('shipping', 'order.shipping_id', '=', 'shipping.shipping_id')
                   ->select('order.*', 'order_details.*', 'shipping.*', 'customer.*')
                   ->get();

        return view('admin.view_order', compact('order_by_id'));
    }

    public function customer_logout()
    {
        Session::flush();
        return Redirect::to('/');
    }

    // private function sslapi()
    // {

    // }
}
