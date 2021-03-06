<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Cart;

class CheckoutController extends Controller
{
    public $loginAfterSignUp = true;

    public function register(RegisterAuthRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
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

        return response()->json([
            'success' => true,
            'data' => $shipping_id
        ], 200);
            //return Redirect::to('/payment');
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
        $orderData['user_id'] = Session::get('user_id');
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
            return response()->json([
                'success' => true,
                'message' => 'Transaction Successfully Done By Handcash !!!',
            ], 200);
            //return response()->json('handcash', 200);
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
                   ->join('users', 'order.user_id', '=', 'users.user_id')
                   ->select('order.*', 'users.name')
                   ->get();

        //return view('admin.manage_order', compact('all_order_info'));
        return response()->json([
            'success' => true,
            'data' => $all_order_info,
            'message' => 'This is all successfully placed orders !!!',
        ], 200);
    }

    public function view_order($order_id)
    {
        $order_by_id = DB::table('order')
                   ->join('users', 'order.user_id', '=', 'users.user_id')
                   ->join('order_details', 'order.order_id', '=', 'order_details.order_id')
                   ->join('shipping', 'order.shipping_id', '=', 'shipping.shipping_id')
                   ->select('order.*', 'order_details.*', 'shipping.*', 'users.*')
                   ->get();

        //return view('admin.view_order', compact('order_by_id'));

        return response()->json([
            'success' => true,
            'data' => $order_by_id,
            'message' => 'This is a successfully placed order !!!',
        ], 200);
    }

    // public function customer_logout()
    // {
    //     Session::flush();
    //     return Redirect::to('/');
    // }

}
