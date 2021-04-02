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


    public function update(Client $client,UpdateClientApprovalRequest $request) 
    {
        if(!$client->approval){
            $client->user->notify(new ClientApprovedNotification($client->user));
        }
        $requestData = $request->all();   
        $requestData['approval'] = true;
        $requestData['receptionist_id'] = Auth::user()->receptionist->id;
        $client->update($requestData);
        return redirect()->route('client.index');
    }


    public function destroy(Client $client)
    {
        
        $user = $client->user();
        try {
            if ($client->delete()) {
                $user->delete();
            }
        } catch (\Exception $exception) {
            return response($exception->getMessage())->setStatusCode(400);
        }
        return response("Deleted Successfully");

    }
        
    
}


