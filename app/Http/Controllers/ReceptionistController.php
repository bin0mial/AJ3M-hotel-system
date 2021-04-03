<?php

namespace App\Http\Controllers;

use App\DataTables\ReceptionistDataTable;
use App\Http\Requests\StoreReceptionistRequest;
use App\Http\Requests\UpdateReceptionistRequest;
use App\Models\Manager;
use App\Models\Receptionist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceptionistController extends Controller
{
    public function index(ReceptionistDataTable $dataTable){
        return $dataTable->render('receptionists.index');
    }

    public function create(){
        return view('receptionists.create',[
            "managers" => Manager::all()
        ]);
    }

    public function store(StoreReceptionistRequest $request){
        $user = User::create($request->validated());
        $user->assignRole('receptionists');
        $manager_id = Auth::user()->hasRole('manager') ?  Auth::user()->manager->id : $request->manager_id;
        Receptionist::create(["user_id" => $user->id ,"manager_id" => $manager_id]);
        return redirect()->back()->with(["success" => ["message" => "Receptionist Created Successfully"]]);
    }

    public function edit(Receptionist $receptionist){
        if (Auth::user()->hasRole('admin')  || $receptionist->manager_id == Auth::user()->manager->id ){
            return view('receptionists.edit',[
                "receptionist"  => $receptionist,
                "manager"       =>  Manager::find($receptionist->manager_id),
                "managers"      => Manager::all(),
            ]);
        }
        return redirect()->route('receptionists.index')
            ->with(["error" => ["message" => "Unauthorized Action <i class='fas fa-ban'></i>"]]);
    }

    public function update(UpdateReceptionistRequest $request ,Receptionist $receptionist){
        $manager_id = Auth::user()->hasRole('manager') ?  Auth::user()->manager->id : $request->manager_id;
        $valid = $request->validated();
        $valid['manager_id'] = $manager_id;
        $receptionist->user->update(array_filter($valid, function ($value) {
            return $value !== null;
        }));
        $receptionist->update([
            "manager_id" => $manager_id,
        ]);
        return redirect()->route('receptionists.index')
                ->with(["success" => ["message" => "Receptionist Updated Successfully"]]);
    }

    public function destroy(Receptionist $receptionist){
        if (Auth::user()->hasRole('admin')  || $receptionist->manager_id == Auth::user()->manager->id ){
            $receptionist->delete();
            $receptionist->user->delete();
            return redirect()->route('receptionists.index')
                ->with(["danger" => ["warning" => "Receptionist Deleted Successfully"]]);
        }
//        return redirect()->route('receptionists.index')
//            ->with(["error" => ["message" => "Unauthorized Action <i class='fas fa-ban'></i>"]]);
        return response("Unauthorized Action");
    }

    public function ban(Receptionist $receptionist){
        if (Auth::user()->hasRole('admin')  || $receptionist->manager_id == Auth::user()->manager->id ){
            $user = $receptionist->user;
            if ($user->isBanned()){
                $user->unban();
            } else {
                $user->ban();
            }
        }
        return redirect()->route('receptionists.index')
            ->with(["error" => ["message" => "Unauthorized Action <i class='fas fa-ban'></i>"]]);
    }

}
