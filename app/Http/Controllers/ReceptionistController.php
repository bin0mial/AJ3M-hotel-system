<?php

namespace App\Http\Controllers;

use App\DataTables\ReceptionistDataTable;
use App\Http\Requests\ReceptionistStoreRequest;
use App\Http\Requests\ReceptionistUpdateRequest;
use App\Http\Requests\StoreReceptionistRequest;
use App\Http\Requests\StoreReceptRequest;
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
        $user->assignRole('receptionist');
        $manager_id = Auth::user()->hasRole('manager') ?  Auth::user()->manager->id : $request->manager_id;
        Receptionist::create(["user_id" => $user->id ,"manager_id" => $manager_id]);
        return redirect()->back()->with(["success" => ["message" => "Receptionist Created Successfully"]]);
    }

    public function edit($receptionist){
        return view('receptionists.edit',[
            "receptionist" => User::find($receptionist),
            "managers" => Manager::all(),
        ]);
    }

    public function update(UpdateReceptionistRequest $request ,$receptionist_id){
        User::where('id', $receptionist_id)
            ->update([
                'name'          => $request['name'],
                'email'         => $request['email'],
                'national_id'   => $request['national_id'] ? $request['national_id'] : "",
            ]);
        return redirect()->route('receptionists.index')
                ->with(["success" => ["message" => "Receptionist Updated Successfully"]]);
    }

    public function destroy($id){
        $user = User::find($id);
        Receptionist::find($user->receptionist->id)->delete();
        $user->delete();
        return redirect()->route('receptionists.index')
                    ->with(["danger" => ["error" => "Receptionist Deleted Successfully"]]);
    }

    public function ban($id){
        $user = User::find($id);
        if ($user->hasRole('ban')){
            $user->removeRole('ban');
        } else {
            $user->assignRole('ban');
        }
    }

}
