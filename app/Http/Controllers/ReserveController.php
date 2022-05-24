<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;
use App\Models\Reserve;

class ReserveController extends Controller
{
    public function done() {
        return view('done');
    }

    public function store(ReserveRequest $request) {
        Reserve::create([
            'shop_id' => $request->shop_id,
            'user_id' => $request->user_id,
            'date' => $request->date,
            'time' => $request->time,
            'number' => $request->number,
        ]);
        return redirect('done');
    }
    
    public function destroy(Request $request,$user_id) {
        Reserve::find($request->reserve_id)->delete();
        return redirect('/mypage/'.$user_id);
    }
}
