<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrowsingHistory extends Model
{
    use HasFactory;

    // 1-N
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    } 
}
