<?php

namespace App\Http\Controllers;


use App\Product;
use App\Carta;
use App\Category;
use App\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use DB;

class PaymentController extends Controller
{
    public function pay(){




        return view('payment');
    }
    }

