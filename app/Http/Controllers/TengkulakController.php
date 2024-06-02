<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TengkulakController extends Controller
{
    // dashboard
    public function index(){
        return view('dashboard');
     }

     // create lelang cabai
    public function createLelang(){
        return view('create_lelang');
    }

    // view lelang cabai
    public function lelangBerjalan(){
        return view('view_lelang');
    }

    // view payment status lelang cabai
    public function paymentStatus(){
        return view('payment_status');
    }

    // view history status lelang cabai
    public function historyStatus(){
        return view('history_status_lelang');
    }
}
