<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mypage() 
    {
        $user = User::with(['favorites', 'reserves'])->find(auth()->id());
        
        return view('mypage', [
            'user' => $user
        ]);
    }

    public function management()
    {
        $users = User::where('role', 5)->get();
        return view('management', ['users' => $users]);
    }

    public function store(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
        ]);

        return redirect('/management');
    }

    public function delete(Request $request)
    {
        User::find($request->user_id)->delete();

        return redirect('/management');
    }
}
