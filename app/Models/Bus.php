<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
