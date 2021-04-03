<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientReservationRequest;
use App\Models\Client;
use App\Models\ClientReservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ClientReservationController extends Controller
{

    public function index()
    {
        return view('clients.index',[
            "rooms" => Room::where("reserved" ,"=" ,"0")->get()
        ]);
    }

    public function reserve(Room $room){
        return view('clients.reserve' ,
        [
            "room" => $room,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreClientReservationRequest $request ,Room $room)
    {
        $valid = $request->validated();
        $checkout = $request->user()->checkoutCharge($room->getNormalPrice()*100 ,"Room Number: ".$room->number ,$valid['nights_number'], [
            "success_url"   => route('clientHome.successReserve' ,[$room])
                ."?checkout=success"
                ."&accompany_number=" .$valid['guests_number']
                ."&days=".$valid['nights_number']
                ."&client_id=".Auth::user()->client->id
                ."&paid_price=".$room->getNormalPrice()
                ."&room_id=".$room->id,
            "cancel_url"    => url()->previous()
        ]);
        $room->reserve();
        return view('clients.payment',[
            "request"   => $request,
            "room"      => $room,
            "checkout"  => $checkout->button("Reserve"),
        ]);
    }

    public function successReserve(Request $request){
//        $request['room_id'] = $room->number;
//        dd($request->all());
        ClientReservation::create($request->all());
        return redirect()->route('clientHome.index')->with(["success" => ["message" => "Room Reserved Successfully"]]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
