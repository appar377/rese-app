<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'user_id',
        'date',
        'time',
        'number',
    ];

    public function user(){ 
        return $this->belongsTo('App\Models\User');
    }

    public function shop(){ 
        return $this->belongsTo('App\Models\Shop');
    }
}
