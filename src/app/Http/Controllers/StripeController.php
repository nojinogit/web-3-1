<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripeController extends Controller
{
    public function stripe(Request $request){
    // Stripeライブラリの初期化
    Stripe::setApiKey(config('stripe.stripe_secret_key'));

    // Customerオブジェクトの作成
    $customer = \Stripe\Customer::create([
    'name' => 'aaa',
    'email' => 'nojinonoue@yahoo.co.jp',
    ]);

    $intent = PaymentIntent::create([
    'amount' => 19000,
    'currency' => 'jpy',
    'customer' => $customer->id,
    'payment_method_types' => ['customer_balance'],
    'payment_method_data' => [
      'type' => 'customer_balance',
    ],
    'payment_method_options' => [
      'customer_balance' => [
        'funding_type' => 'bank_transfer',
        'bank_transfer' => [
          'type' => 'jp_bank_transfer',
        ],
      ],
    ],
    'confirm' => true,
    ]);

    //$clientSecret = $intent->client_secret;

    $nextAction=$intent->next_action;

    //dd($nextAction);

    return view('payment', compact('nextAction'));

    }
}