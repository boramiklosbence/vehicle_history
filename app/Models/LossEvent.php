<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LossEvent extends Model
{
    use HasFactory;

    // N-N
    public function vehicles() {
        return $this->belongsToMany(Vehicle::class)->withTimestamps();
    }
}
