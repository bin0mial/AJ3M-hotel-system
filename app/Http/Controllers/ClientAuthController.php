<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientAuthController extends Controller
{
    public function index()
    {
        return view('auth.clientLogin');
    }

    public function register(){
        return view('auth.clientRegister',[
            'countries' => countries()
        ]);
    }
}
