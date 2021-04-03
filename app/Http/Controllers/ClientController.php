<?php

namespace App\Http\Controllers;

use App\DataTables\ApprovedClientsDataTable;
use App\DataTables\ClientDataTable;
use App\DataTables\ClientReservationDataTable;
use App\Http\Requests\UpdateClientApprovalRequest;
use App\Models\Client;
use App\Models\Receptionist;
use App\Models\User;
use App\Notifications\ClientApprovedNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Request\ShowClientReservation;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index (ApprovedClientsDataTable $DataTable){
        return $DataTable->render("client.index");
    }
    
    public function pending (ClientDataTable $DataTable){
        return $DataTable->render("client.pending");
    }

    public function get_Reservation(ClientReservationDataTable $DataTable)
    {
      
        return $DataTable->render("client.reservation");

    }


    public function accept(Client $client)
    {
        
        $receptionists = Receptionist::all();
    
        return view('client.accept',[
            'client' => $client,
            'receptionists' => $receptionists
        ]);
    }


    public function update(UpdateClientApprovalRequest $request,Client $client) 
    {
        
        $receptionist_id = Auth::user()->hasRole('receptionists') ?  Auth::user()->receptionist->id : $request->receptionist_id;
  
        if(!$client->approval){
            $client->user->notify(new ClientApprovedNotification($client->user));
        }
        $requestData = $request->all();   
        $requestData['approval'] = true;
        $requestData['receptionist_id'] = $receptionist_id ;
        $client->update($requestData);
        return redirect()->route('client.index');
    }


    
        
    
}


