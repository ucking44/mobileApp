<?php

namespace App\Http\Controllers;

use App\Payment;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Omnipay\Omnipay;

class OminiPaymentController extends Controller
{
    public $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Pro');
        $this->gateway->setUsername(env('PAYPAL_API_USERNAME', 'sb-ni47s46317465_api1.business.example.com'));
        $this->gateway->setPassword(env('PAYPAL_API_PASSWORD', '8Q3R7W42FB8CPPT5'));
        $this->gateway->setSignature(env('PAYPAL_API_SIGNATURE', 'A02X.K7GjnEoug.blfyz-e3rD5F9APMmKnNonXliUkjyy06S.iF0288n'));
        $this->gateway->setTestMode(true); // here 'true' is for sandbox. Pass 'false' when go live
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payment.payment');
    }

    public function store(Request $request)
    {
        $arr_expiry = explode("/", $request->input('expiry'));

        $formData = array(
            'firstName' => $request->input('first-name'),
            'lastName' => $request->input('last-name'),
            'number' => $request->input('number'),
            'expiryMonth' => trim($arr_expiry[0]),
            'expiryYear' => trim($arr_expiry[1]),
            'cvv' => $request->input('cvc'),
            //'user' => Auth::user()
        );

        try {
            // Send purchase request
            $response = $this->gateway->purchase([
                'amount' => $request->input('amount'),
                'currency' => 'USD',
                'card' => $formData
            ])->send();

            // Process response
            if ($response->isSuccessful()) {

                // Payment was successful
                $arr_body = $response->getData();
                $amount = $arr_body['AMT'];
                $currency = $arr_body['CURRENCYCODE'];
                $transaction_id = $arr_body['TRANSACTIONID'];
                //$message = $arr_body['SUCCESS'];

                //$isPaymentExist = Payment::where('payment_id', auth()->user()->id)->first();
                $isPaymentExist = Payment::where('user_id', auth()->user()->id)->first();

                if(!$isPaymentExist)
                {
                    $payment = new Payment();
                    //$payment->payment_id = $request->transaction_id;
                    $payment->payer_email = $request->email; //['payer']['payer_info']['payer_id'];
                    $payment->firstName = Auth::user()->firstName;;
                    $payment->lastName = Auth::user()->lastName;;
                    $payment->user_email = Auth::user()->email; //$request->email; //$arr_body['payer']['payer_info']['email'];
                    $payment->amount = $request->amount; //$arr_body['transactions'][0]['amount']['total'];
                    //$payment->currency = env('PAYPAL_CURRENCY');
                    $payment->user_id = Auth::user()->id;
                    // $payment->associate_id = $request->associate_id;
                    // $payment->corporate_id = $request->corporate_id;
                    // $payment->fellow_id =  $request->fellow_id;
                    // $payment->full_id = $request->full_id;
                    // $payment->student_id = $request->student_id;
                    $payment->payment_status = true; //$arr_body['state'];
                    if(!isset($request->payment))
                    {
                        $payment->payment = 'paid';
                    } else {
                        $payment->payment = 'not-paid';
                    }
                    $payment->save();

                    // if ($payment->payment_status == true)
                    // {
                    //     Student::where('payment_id', 0)->update([
                    //         'payment_id' => 1
                    //     ]);
                    // }

                    // DB::table('users')->where('users.id', $id)->where('usertype', 'null')
                    //                   ->update(['usertype' => 'student']);
                    // DB::table('users')
                    //                 ->where('users.id', $id)
                    //                 ->where('usertype', 'null')->update([
                    //     'usertype' => 'student'
                    // ]);

                }


                //$user = User::where('usertype', '=', 'admin')->get();

                //// $data = [];
                //// $data['firstName'] = Auth::user();
                //// $data['title'] = 'Title';

                //$data = Auth::user()->email;
                //Notification::send($user, new PaymentNotification($data));

                return response()->json([
                    'success' => true,
                    'payment' => $amount,
                    'currency' => $currency,
                    'transaction_id' => $transaction_id,
                    //'data' => $user
                ], 200);

                //return Redirect::to('/success/payment')->with('success', 'Payment of ' . $amount .' '. $currency  . ' is successful.  Your Transaction ID is : ' . $transaction_id);

                //echo "Payment of $amount $currency is successful. Your Transaction ID is: $transaction_id";
            } else {
                // Payment failed
                return response()->json([
                    'success' => false,
                    'message' => 'Payment failed. ' . $response->getMessage(),
                ], 401);
                //return Redirect::to('/failed/payment')->with('error', 'Payment failed. ' . $response->getMessage());
                //echo "Payment failed. ". $response->getMessage();
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }

    }

}
