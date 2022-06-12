<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Session;


class ShopController extends Controller
{
    public function index() 
    {
        $shops = Shop::with('favorites')->get();
        $areas = Area::all();
        $genres = Genre::all();

        Session::remove('genre');
        Session::remove('area');

        return view('index', [
            'shops' => $shops,
            'areas' => $areas,
            'genres' => $genres
        ]);
    }

    public function detail($shop_id) 
    {
        $shop = Shop::find($shop_id);
        return view('detail',['shop' => $shop]);
    }

    public function search(Request $request) 
    {
        $areas = Area::all();
        $genres = Genre::all();

        $query = Shop::query();

        if(!empty($request->area_id)) {
            $query->where('area_id', $request->area_id);
            Session::flash('area', $request->area_id);
        }

        if(!empty($request->genre_id)) {
            $query->where('genre_id',$request->genre_id);
            Session::flash('genre', $request->genre_id);
        }

        if(!empty($request->search)) {
            $query->where('name','like',"%$request->search%");
        }

        $shops = $query->with('favorites')->get();

        return view('index', [
            'shops' => $shops,
            'areas' => $areas,
            'genres' => $genres
        ]);
    }
}
