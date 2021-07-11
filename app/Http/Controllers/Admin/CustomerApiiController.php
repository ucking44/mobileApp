<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRegisterRequest;
use App\Customer;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class CustomerApiController extends Controller
{
    public $loginAfterSignUp = true;

    public function customerRegister(CustomerRegisterRequest $request)
    {
        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->customer_email = $request->customer_email;
        $customer->password = bcrypt($request->password);
        $customer->mobile_number = bcrypt($request->mobile_number);
        $customer->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success' => true,
            'data' => $customer
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

        $customer = JWTAuth::authenticate($request->token);

        return response()->json(['customer' => $customer]);
    }
}
