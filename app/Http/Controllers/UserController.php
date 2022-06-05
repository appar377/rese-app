<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function mypage() 
    {
        $user = Auth::user();
        $reserves = Auth::user()->reserves;
        $favorites = Auth::user()->favorites;
        return view('mypage', [
            'user' => $user, 
            'reserves' => $reserves, 
            'favorites' => $favorites
        ]);
    }
}
