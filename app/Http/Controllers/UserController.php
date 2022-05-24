<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function mypage() {
        return view('/mypage');
    }
}
