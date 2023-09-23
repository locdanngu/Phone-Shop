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
                'idorder' => $request->idorder,
                'amount' => $request->amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success', ['idorder' => $request->idorder]), // Thêm idorder vào returnUrl
                'cancelUrl' => url('error', ['idorder' => $request->idorder]),
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

    public function success(Request $request, $idorder){
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
                $payment->idorder = $idorder;
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];
                $payment->save();

                $order = Order::where('idorder', $idorder)->first();
                $order->status = 'wait';
                $order->pay = 'paypal';
                $order->save();
                return redirect()->route('historyorder.page', ['idorder' => $idorder]);
            }else{
                return $response->getMessage();
            }
        }else{
            return redirect()->route('checkout.page', ['idorder' => $idorder]);
        }
    }

    public function error(Request $request, $idorder){
        return redirect()->route('checkout.page', ['idorder' => $idorder]);
    }
}
