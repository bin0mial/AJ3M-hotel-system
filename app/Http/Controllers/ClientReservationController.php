<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        //
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
