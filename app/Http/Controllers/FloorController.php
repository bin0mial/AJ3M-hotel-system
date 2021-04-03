<?php

namespace App\Http\Controllers;

use App\DataTables\FloorDataTable;
use App\Http\Requests\StoreFloorRequest;
use App\Http\Requests\UpdateFloorRequest;
use App\Models\Floor;
use App\Models\Manager;
use Faker\Provider\sk_SK\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FloorController extends Controller
{

    public function index(FloorDataTable $dataTable){
        return $dataTable->render('floors.index');
    }

    public function create(){
        $floor_ids_array = Floor::pluck("id")->toArray();
        $floor_num = rand(1000, 9000);
        while (in_array($floor_num, $floor_ids_array)){
            $floor_num = rand(1000, 9000);
        }

        return view('floors.create',
        [
            "managers"  => Manager::all(),
            "number"    => $floor_num,
        ]);
    }

    public function store(StoreFloorRequest $request){
        $valid = $request->validated();
        $manager_id = Auth::user()->hasRole('manager') ?  Auth::user()->manager->id : $request->manager_id;
        $valid["manager_id"] = $manager_id;
        Floor::create($valid);
        return redirect()->back()->with(["success" => ["message" => "Floor Created Successfully <i class='fas fa-smile-beam'></i>"]]);
    }

    public function edit(Floor $floor){
        return view("floors.edit" ,
        [
            "floor"     => $floor,
            "managers"  => Manager::all(),
        ]);
    }

    public function update(UpdateFloorRequest $request,Floor $floor){
        $floor->update(array_filter($request->validated(), function ($value) {
            return $value !== null;
        }));
        return redirect()->route('floors.index')->with(["success" => ["message" => "Floor Updated Successfully"]]);
    }

    public function destroy(Floor $floor){
        try {
            $floor->delete();
        } catch (\Exception $exception) {
            return response("Please remove rooms in this floor first")->setStatusCode(400);
        }
        return response("deleted successfully");
    }

}
