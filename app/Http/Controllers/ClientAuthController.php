<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientAuthController extends Controller
{
    public function index()
    {
        return view('auth.clientLogin');
    }

    public function loggedIn(){
        return view('clients.index');
    }

    public function register(){
        return view('auth.clientRegister',[
            'countries' => countries()
        ]);
    }

    public function store(StoreClientRequest $request){
        $valid = $request->validated();
        $user = User::create($valid);
        $valid['user_id'] = $user->id;
        $valid['approval'] = "false";
        Client::create($valid);
        $user->createAsStripeCustomer();
        return redirect('/');
    }
}
