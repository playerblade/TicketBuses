<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function ticket($bus_id , $city_id){
        Ticket::join('buses','tickets.bus_id','=','buses.id')
            ->join('seats','seats.bus_id','=','buses.id')
            ->join('prices','buses.id','=','prices.bus_id')
            ->join('cities','prices.city_id','=','cities.id')
            ->where('prices.bus_id',$bus_id)
            ->where('prices.city_id',$city_id)
//            ->where('seats.bus_id',$request->bus_id)
            ->select('cities.name','prices.price','tickets.created_at','tickets.total','tickets.quantity','tickets.client','tickets.ci')->first();

    }
}
