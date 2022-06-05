<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request) 
    {
        Favorite::create([
            'shop_id' => $request->shop_id,
            'user_id' => Auth::id(),
        ]);
        
        return back();
    }

    public function destroy(Request $request) 
    {
        Favorite::where('shop_id', $request->shop_id)->where('user_id', Auth::id())->delete();

        return back();
    }
}
