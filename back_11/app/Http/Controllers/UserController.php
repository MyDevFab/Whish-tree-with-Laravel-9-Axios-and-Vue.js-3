<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $users = User::All();
        return UserResource::collection($users);
    }



    public function store(UserRequest $request)
    {

        $users = User::create($request->all());
        
        return new UserResource($users);
        
    }

    public function show($id)
    {
        $user = new UserResource(User::findOrFail($id));
       
        return response()->json($user);
    }


    public function edit(User $user)
    {
        //
    }


    public function update(UserRequest $request,  User $user)
    {
            
        $user->update($request->all());
        
        return new UserResource($user);
    }


    public function destroy(User $user)
    {
        $user->delete();
        return response(null, 204);
    }

    public function addFriend($id) {
        
        return auth()->user()->friends()->attach([$id]);
        
    }

    public function removeFriend($id) {

        return auth()->user()->friends()->detach([$id]);
        
    }
    public function changeAvatar(Request $request, $id,  User $user){

        $this->validate($request, [
            'avatar' => 'required',
        ]);

        $user = User::findorfail($id);

        $user->avatar = $request->avatar;

        $user->save();

        return response()->json($user);

   
    }

    public function search($name, User $user)
    {
        $user = User::where('name', 'like', '%'.$name.'%')->get();
        
        return response()->json($user);
    }
}
