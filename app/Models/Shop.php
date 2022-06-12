<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'area_id',
        'genre_id',
        'content',
        'img',
    ];

    protected $guarded = [
        'id'
    ];

    public function favorites()
    { 
        return $this->hasMany('App\Models\Favorite');
    }

    public function area()
    { 
        return $this->belongsTo('App\Models\Area');
    }

    public function genre()
    { 
        return $this->belongsTo('App\Models\Genre');
    }

    public function is_liked_by_auth_user()
    {
        $id = Auth::id();

        $favorite_users = array();
        foreach($this->favorites as $favorite) {
            array_push($favorite_users, $favorite->user_id);
        }

        if(in_array($id, $favorite_users)) {
            return true;
        } else {
            return false;
        }
    }
}
