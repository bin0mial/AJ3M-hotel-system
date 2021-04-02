<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index(){
        return RoomResource::collection(Room::paginate(10));
    }
}
