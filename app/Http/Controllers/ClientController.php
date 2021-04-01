<?php

namespace App\Http\Controllers;

use App\DataTables\ClientDataTable;
use App\Models\ApprovedClients;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index (ApprovedClients $DataTable){
        return $DataTable->render("client.index");
    }
    
    public function pending (ClientDataTable $DataTable){
        return $DataTable->render("client.pending");
    }


    public function apply($id)
    {
         
         
        $client = Client::find($id);

   
        if($client){
            $client->receptionist_id =Auth::user()->hasRole('receptionist')? Auth::user()->receptionist->id : $request->receptionist_id;
            $client->save();
        }
        
    }
}


