<?php

namespace App\Http\Controllers;

use App\DataTables\ManagerDataTable;
use App\Http\Requests\ManagerRequest;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index(ManagerDataTable $managerDataTable){
        return $managerDataTable->render("managers.index");
    }

    public function create(){
        return view("managers.create");
    }

    public function store(ManagerRequest $request){
        $user = User::create($request->validated());
        $user->assignRole('manager');
        Manager::create(["user_id" => $user->id]);
        return redirect()->route("managers.index");
    }

    public function show(Manager $manager){
        return view("managers.show", ["manager"=>$manager]);
    }

    public function edit(Manager $manager){
        return view("managers.edit", ["manager"=>$manager]);
    }

    public function update(ManagerRequest $request, Manager $manager){
        $manager->user->update($request->validated());
        return redirect()->route("managers.index");
    }

    public function destroy(Manager $manager){
        $manager->user->delete();
        return redirect()->route("managers.index");
    }
}
