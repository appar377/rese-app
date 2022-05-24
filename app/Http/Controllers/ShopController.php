<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveRequest;

use Illuminate\Http\Request;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Session;


class ShopController extends Controller
{
    public function index() {
        $items = Shop::all();
        $areas = Area::all();
        $genres = Genre::all();

        Session::flush();

        return view('index',[
            'items'=>$items,
            'areas'=>$areas,
            'genres'=>$genres
        ]);
    }

    public function detail($shop_id) {
        $item = Shop::find($shop_id);
        return view('detail',['item'=>$item]);
    }

    public function search(Request $request) {
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

        $items = $query->get();

        return view('index',[
            'items'=>$items,
            'areas'=>$areas,
            'genres'=>$genres
        ]);
    }
}
