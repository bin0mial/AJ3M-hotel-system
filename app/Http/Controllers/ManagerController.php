<?php

namespace App\Http\Controllers;

use App\DataTables\ManagerDataTable;
use App\Http\Requests\StoreManagerRequest;
use App\Http\Requests\UpdateManagerRequest;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManagerController extends Controller
{
    public function index(ManagerDataTable $managerDataTable)
    {
        return $managerDataTable->render("managers.index");
    }

    public function create()
    {
        return view("managers.create");
    }

    public function store(StoreManagerRequest $request)
    {
        $user = User::create($request->validated());
        $user->assignRole('manager');
        Manager::create(["user_id" => $user->id]);
        return redirect()->back()->with(["success" => ["message" => "Manager Created Successfully"]]);
    }

    public function show(Manager $manager)
    {
        return view("managers.show", ["manager" => $manager]);
    }

    public function edit(Manager $manager)
    {
        return view("managers.edit", ["manager" => $manager]);
    }

    public function update(UpdateManagerRequest $request, Manager $manager)
    {
        $manager->user->update(array_filter($request->validated(), function ($value) {
            return $value !== null;
        }));
        return redirect()->back()->with("success", ["Manager Updated Successfully"]);
    }

    public function destroy(Manager $manager)
    {
        $user = $manager->user();
        try {
            if ($manager->delete()) {
                $user->delete();
            }
        } catch (\Exception $exception) {
            return response("Please remove people controlled by this manager first or move them")->setStatusCode(400);
        }


        return response("Deleted Successfully");
    }
}
