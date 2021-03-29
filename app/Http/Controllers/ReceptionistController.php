<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\StoreReceptRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function index(UsersDataTable $dataTable){
        return $dataTable->render('manager.index');
//        return view('manager.index',[
//            'recepts'   => User::all()->where('creator_id','=','1')
//        ]);
    }

    public function create(){
        return view('manager.create');
    }

    public function store(StoreReceptRequest $request){
        $user = new User;
        $user->name = $request->recept_name;
        $user->email = $request->recept_email;
        $user->national_id = $request->recept_national_id;
        $user->password = $request->recept_password;
        $user->creator_id = 1; //static at the moment to be changed
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
        return redirect()->route('manager.index');
    }
}
