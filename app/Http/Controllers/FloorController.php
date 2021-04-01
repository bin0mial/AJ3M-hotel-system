<?php

namespace App\Http\Controllers;

use App\DataTables\FloorDataTable;
use App\Http\Requests\StoreFloorRequest;
use App\Http\Requests\UpdateFloorRequest;
use App\Models\Floor;
use App\Models\Manager;
use Faker\Provider\sk_SK\PhoneNumber;
use Illuminate\Http\Request;
use Faker\Factory as Faker;

class FloorController extends Controller
{

    public function index(FloorDataTable $dataTable){
        return $dataTable->render('floors.index');
    }

    public function create(){
        $faker = Faker::create();
        $rand  = $faker->unique()->numberBetween($min = 1000, $max = 9000);
        $check = Floor::where('number',"=", $rand)->get()->isEmpty();
        if ($check){
//            dd("not exist");
        } else {
//            dd("exists");
        }

        return view('floors.create',
        [
            "managers"  => Manager::all(),
            "number"    => $rand,
        ]);
    }

    public function store(StoreFloorRequest $request){
        Floor::create($request->validated());
        return redirect()->back()->with(["success" => ["message" => "Floor Created Successfully"]]);
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

}
