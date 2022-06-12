<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function mypage() 
    {
        $user = User::with(['favorites', 'reserves'])->find(auth()->id());
        
        return view('mypage', [
            'user' => $user
        ]);
    }
}
