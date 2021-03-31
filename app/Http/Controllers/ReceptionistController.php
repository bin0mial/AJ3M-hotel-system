<?php

namespace App\Http\Controllers;

use App\DataTables\ReceptionistDataTable;
use App\Http\Requests\ReceptionistUpdateRequest;
use App\Http\Requests\StoreReceptRequest;
use App\Models\Manager;
use App\Models\Receptionist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceptionistController extends Controller
{
    public function index(ReceptionistDataTable $dataTable){
        return $dataTable->render('receptionists.index');
//        return view('manager.index',[
//            'recepts'   => User::all()->where('creator_id','=','1')
//        ]);
    }

    public function create(){
        return view('receptionists.create',[
            "managers" => Manager::all()
        ]);
    }

    public function store(StoreReceptRequest $request){
//        $user = new User;
//        $user->name = $request->recept_name;
//        $user->email = $request->recept_email;
//        $user->national_id = $request->recept_national_id;
//        $user->password = $request->recept_password;
//        $user->assignRole('receptionists');
//        if($request->hasFile('recept_image')){
//            $file = $request->file('recept_image');
//            $extension = $file->getClientOriginalExtension();
//            $check = in_array($extension,['jpg','jpeg']);
//            if($check){
//                $user->avatar_image = $request->recept_image;
//            } else {
//                dd("to do show fail message for extension");
//            }
//        }
//        $user->save();
//        $receptionists = new Receptionist;
//        if($request->manager_id){
//            $receptionists->manager_id = $request->manager_id;
//        } else {
//            $receptionists->manager_id = Auth::user()->id;
//        }
//        $receptionists->user_id = $user->id;
//        $receptionists->save();
//        return redirect()->route('receptionists.index');
        $user = User::create($request->validated());
        $user->assignRole('receptionist');
        $managerId = Auth::user()->hasRole('manager') ?  Auth::user()->manager->id : $request->manager_id;
        Receptionist::create(["user_id" => $user->id ,"manager_id" => $managerId]);
        return redirect()->back()->with(["success" => ["message" => "Manager Created Successfully"]]);
    }

    public function edit($receptionist){
        return view('receptionists.edit',[
            "receptionist" => User::find($receptionist),
        ]);
    }

    public function update(ReceptionistUpdateRequest $request ,$receptionist_id){
        User::where('id', $receptionist_id)
            ->update([
                'name'          => $request['recept_name'],
                'email'         => $request['recept_email'],
                'national_id'   => $request['recept_national_id'] ? $request['recept_national_id'] : "",
            ]);
        return redirect()->route('receptionists.index');
    }

    public function destroy($id){
        dd("test");
//        $receptionists = Receptionist::find($id);
//        $receptionists->user->delete();
    }

}
