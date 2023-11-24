<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    // N-N
    public function loss_events() {
        return $this->belongsToMany(LossEvent::class)->withTimestamps();
    }
}
