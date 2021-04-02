<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit(User $user)
    {
        if ($user->id !== Auth::user()->id) {
            abort(403);
        }
        return view("users.edit", ["user" => $user]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update(array_filter($request->validated(), function ($value) {
            return $value !== null;
        }));
        return redirect()->back()->with("success", ["User has been updated successfully"]);
    }
}
