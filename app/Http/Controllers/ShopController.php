<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShopRequest;
use Illuminate\Http\Request;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function index() 
    {
        if (Auth::check()) {
            if (Auth::user()->role == 1) {
                return redirect('/management');
            } elseif (Auth::user()->role == 5) {
                return redirect('/create_shop');
            } else {
                $user_id = Auth::id();
                $shops = Shop::with(['favorites' => function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                }])->get();
                $areas = Area::all();
                $genres = Genre::all();
        
                return view('index', [
                    'shops' => $shops,
                    'areas' => $areas,
                    'genres' => $genres
                ]);
            }
        }

        $shops = Shop::all();

        $areas = Area::all();
        $genres = Genre::all();

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
        $user_id = Auth::id();
        $areas = Area::all();
        $genres = Genre::all();

        $area_id = $request->area_id;
        $genre_id = $request->genre_id;
        $search = $request->search;

        $query = Shop::query();

        if(!empty($area_id)) {
            $query->where('area_id', $area_id);
        }

        if(!empty($genre_id)) {
            $query->where('genre_id',$genre_id);
        }

        if(!empty($search)) {
            $query->where('name','like',"%$search%");
        }

        $shops = $query->with(['favorites' => function($query) use($user_id) {
            $query->where('user_id', $user_id);
        }])->get();

        return view('index', [
            'shops' => $shops,
            'areas' => $areas,
            'genres' => $genres,
            'area_id' => $area_id,
            'genre_id' => $genre_id,
            'search' => $search,
        ]);
    }

    public function create_shop() 
    {
        $areas = Area::all();
        $genres = Genre::all();

        $user_id = auth()->user()->id;

        $shops = Shop::where('user_id', $user_id)->get();

        return view('create_shop', [
            'areas' => $areas,
            'genres' => $genres,
            'shops' => $shops,
        ]);
    }

    public function store(CreateShopRequest $request) 
    {
        $img = $request->file('img');
        $path = Storage::disk('public')->putFile('img', $img);

        Shop::create([
            'name' => $request->name,
            'img' => $path,
            'user_id' => auth()->user()->id,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'content' => $request->content,
            'course' => $request->course,
            'price' => $request->price,
        ]);

        return redirect('/create_shop');
    }

    public function update(Request $request)
    {
        if(empty($request->img)) {
            $path = $request->oldImg;
        } else {
            $img = $request->file('img');
            $path = Storage::disk('public')->putFile('img', $img);
            Storage::disk('public')->delete($request->oldImg);
        }

        Shop::find($request->shop_id)->update([
            'name' => $request->name,
            'img' => $path,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'content' => $request->content,
            'course' => $request->course,
            'price' => $request->price,
        ]);

        return redirect('/create_shop');
    }

    public function delete(Request $request)
    {
        $shop_id = $request->shop_id;
        $shop = Shop::find($shop_id);
        $shopImg = $shop->img;

        Storage::disk('public')->delete($shopImg);

        Shop::find($shop_id)->delete();

        return redirect('create_shop');
    }
}
