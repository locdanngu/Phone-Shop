<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Omnipay\Paypal\RestGateway;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Product;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct(){
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function index(){
        return view('Payment');
    }

    public function pay(Request $request){
        
        try{
            $response = $this->gateway->purchase(array(
                'amount' => $request->amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error'),
            ))->send();

            if($response->isRedirect()){
                $response->redirect();
            }else{
                return $response->getMessage();
            }
        } catch(\Throwable $th){
            return $th->getMessage();
        }
        
    }

    public function success(Request $request){
        if($request->input('paymentId') && $request->input('PayerID')){
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'              => $request->input('PayerID'),
                'transactionReference'  => $request->input('paymentId'),
            ));

            $response = $transaction->send();

            if($response->isSuccessful()){
                $arr = $response->getData();
                $payment = new Payment;
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];
                $payment->save();

                // return "Payment is successful. Your transaction id is: ". $arr['id'];
                $user = Auth::user();
                $totalPrice = $payment->amount;
                $cartItems = Cart::where('id', $user->id)->where('status', 0)->get();
                // dd($cartItems);
                foreach ($cartItems as $cartItem) {
                    $notification = new Notification;
                    $notification->id = $user->id;
                    $productName = Product::select('nameproduct')->where('idproduct', $cartItem->idproduct)->first()->nameproduct;
                    $image = Product::select('image')->where('idproduct', $cartItem->idproduct)->first()->image;
                    $notification->notification = 'Your order for product "' . $productName . '" x' . $cartItem->quatifier . ' is "waiting for confirmation"';
                    $notification->image = $image;
                    $notification->status = 1;
                    // dd($notification);
                    $notification->save();  
                }
                Cart::where('id', $user->id)->where('status', 0)->update(['status' => 1]);
                $user = User::findOrFail($user->id);
                $user->balance -= $totalPrice;
                $user->save();
                return redirect()->route('order.page');


            }else{
                return $response->getMessage();
            }
        }else{
            return 'Payment declined';
        }
    }

    public function error(){
        return 'User cancelled the payment';
    }
}
