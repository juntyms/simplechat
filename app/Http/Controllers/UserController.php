<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('profile')->with('user',$user);
    }

    public function update(Request $request, $id)
    {


        $user = User::findOrFail($id);

        if ($request->has('password'))
        {
            $request['password'] = bcrypt($request->password);
        }


        $user->update($request->all());

        return redirect()->route('home');
    }

    public function contacts()
    {
        $users = User::all();

        return view('contact')->with('users',$users);
    }

    public function delete($id)
    {
        User::destroy($id);

        return redirect()->route('contacts');
    }
}