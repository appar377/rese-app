<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\Reserve;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request)
    {
        Review::create([
            'star' => $request->star,
            'comment' => $request->comment,
            'reserve_id' => $request->reserve_id,
            'shop_id' => $request->shop_id,
        ]);

        Reserve::find($request->reserve_id)->delete();

        return redirect('/mypage');
    }
}