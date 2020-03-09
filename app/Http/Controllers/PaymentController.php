<?php

namespace App\Http\Controllers;


use App\Product;
use App\Carta;
use App\Category;
use App\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use DB;
use BeGateway\Settings;

class PaymentController extends Controller
{


    public function __construct()
    {
        Settings::$shopId  = 362;
        Settings::$shopKey = '9ad8ad735945919845b9a1996af72d886ab43d3375502256dbf8dd16bca59a4e';
        Settings::$gatewayBase = 'https://demo-gateway.begateway.com';
        Settings::$checkoutBase = 'https://checkout.begateway.com';
    }

    public function pay(){

        $transaction = new \BeGateway\GetPaymentToken;

       $amount = request()->session()->get('totalPrice');

        $transaction->money->setAmount($amount);
        $transaction->money->setCurrency('BYN');
        //$currency = request()->currency;
        //$transaction->money->setCurrency(request()->currency);
       // $transaction->money = currency;
        $transaction->setDescription('test');
        $transaction->setTrackingId = request()->session()->get('carta');
        $transaction->setLanguage('rus');

        $transaction->setTestMode(true);

        $transaction->setNotificationUrl('http://www.example.com/notify');
        $transaction->setSuccessUrl('http://return');
        $transaction->setDeclineUrl('http://return/checkout');
        $transaction->setFailUrl('http://www.example.com/fail');
        $transaction->setCancelUrl('http://www.example.com/cancel');

        $transaction->customer->setFirstName('Johnааа');
        $transaction->customer->setLastName('Doe');
        $transaction->customer->setCountry('LV');
        $transaction->customer->setAddress('Demo str 12');
        $transaction->customer->setCity('Riga');
        $transaction->customer->setZip('LV-1082');
        $transaction->customer->setIp('127.0.0.1');
        $transaction->customer->setEmail('john@example.com');
        $transaction->customer->setBirthDate('1970-01-12');

        $response = $transaction->submit();


        if ($response->isSuccess() )
       // {        }

        $url = $response->getRedirectUrl();
       // return redirect()->to($url);
        return $response->getRedirectUrl();
    }
    }

