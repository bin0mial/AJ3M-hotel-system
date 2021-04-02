<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientReservationRequest;
use App\Models\Room;
use Illuminate\Http\Request;


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
            'success_url' => route('clientHome.index'),
            'cancel_url' => route('clientHome.index'),
        ]);
        return view('clients.payment',[
            "reqeust"   => $request,
            "room"      => $room,
            "checkout"  => $checkout->button("reserve"),
        ]);
    }

    public function pay(){
        dd("test");
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
