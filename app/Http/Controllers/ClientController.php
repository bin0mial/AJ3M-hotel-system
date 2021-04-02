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
        
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */

    // // public function index()     //get all clients
    // // {
    // //     //
    // // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()    // add a new client
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)       // get a specific client
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)       // edit a specific client
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)       // update a specific client
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)        // delete a specific client
    // {
    //     //
    // }
}


