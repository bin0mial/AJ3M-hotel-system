<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\StoreReceptRequest;
use App\Models\Receptionist;
use App\Models\User;
use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function index(UsersDataTable $dataTable){
        return $dataTable->render('receptionist.index');
//        return view('manager.index',[
//            'recepts'   => User::all()->where('creator_id','=','1')
//        ]);
    }

    public function create(){
        return view('receptionist.create');
    }

    public function store(StoreReceptRequest $request){
        $user = new User;
        $user->name = $request->recept_name;
        $user->email = $request->recept_email;
        $user->national_id = $request->recept_national_id;
        $user->password = $request->recept_password;
        $user->assignRole('receptionist');
        if($request->hasFile('recept_image')){
            $file = $request->file('recept_image');
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension,['jpg','jpeg']);
            if($check){
                $user->avatar_image = $request->recept_image;
            } else {
                dd("to do show fail message for extension");
            }
        }
        $user->save();
        $receptionist = new Receptionist;
        $receptionist->manager_id = 1;
        $receptionist->receptionist_id = $user->id;
        $receptionist->save();
        return redirect()->route('receptionist.index');
    }
}
