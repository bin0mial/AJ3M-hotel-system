<?php

namespace App\Http\Controllers;

use App\DataTables\RoomDataTable;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Floor;
use App\Models\Manager;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index(RoomDataTable $dataTable){
        return $dataTable->render('rooms.index');
    }

    public function create(){
        return view('rooms.create',[
            "floors"    => Floor::all(),
            "managers"   => Manager::all(),
        ]);
    }

    public function store(StoreRoomRequest $request){
        $manager_id = Auth::user()->hasRole('manager') ?  Auth::user()->manager->id : $request->manager_id;
        $valid = $request->validated();
        $valid["reserved"] = 0;
        $valid["manager_id"] = $manager_id;
        Room::create($valid);
        return redirect()->back()->with(["success" => ["message" => "Room Created Successfully <i class='fas fa-smile-beam'></i>"]]);
    }

    public function edit(Room $room){
        if (Auth::user()->hasRole('admin') || $room->manager_id == Auth::user()->manager->id){
            return view('rooms.edit' ,[
                "room"           =>  $room,
                "room_manager"   =>   Manager::find($room->manager_id),
                "managers"       =>  Manager::all(),
                "floors"         =>  Floor::all(),
            ]);
        }
        return redirect()->route('rooms.index')->with(["error" => ["message" => "Unauthorized Action <i class='fas fa-ban'></i>"]]);
    }

    public function update(UpdateRoomRequest $request ,Room $room){
        $manager_id = Auth::user()->hasRole('manager') ?  Auth::user()->manager->id : $request->manager_id;
        $valid = $request->validated();
        $valid['manager_id'] = $manager_id;
        $room->update(array_filter($valid, function ($value) {
            return $value !== null;
        }));
        return redirect()->route('rooms.index')
            ->with(["success" => ["message" => "Room Updated Successfully"]]);
    }

    public function destroy(Room $room){
        if ($room->reserved == "No"){
            $room->delete();
            return redirect()->route('rooms.index');
        } else {
            return response("The Room is reserved Can't delete XXX")->setStatusCode(400);
        }
    }

}
