<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function GetCities(Request $request)
    {
        if ($request->ajax()){
            $cities = DB::table('buses')->join('prices','buses.id','=','prices.bus_id')
                      ->join('cities','prices.city_id','=','cities.id')
                      ->where('prices.bus_id',$request->bus_id)
                      ->select('cities.name','cities.id','prices.price')->get();

            foreach ($cities as $city) {
                $cities_array[$city->id] = [$city->name , $city->price];
            }

            return response()->json($cities_array);
        }
    }

    public function GetSubTotal(Request $request)
    {
        if ($request->ajax()){
            $price = DB::table('buses')
                ->join('prices','buses.id','=','prices.bus_id')
                ->join('cities','prices.city_id','=','cities.id')
                ->where('cities.id',$request->city_id)
                ->where('buses.id',$request->bus_id)
                ->select('prices.price')->first();

            return response()->json($price->price);
        }
    }

    public function GetSeats(Request $request)
    {
        if ($request->ajax()){
            $seats = DB::table('buses')->join('seats','buses.id','=','seats.bus_id')
                ->where('buses.id',$request->bus_id)
                ->select('seats.id','seats.number','seats.status')->get();

            foreach ($seats as $seat) {
                if ($seat->status == 1){
                    $seats_array[$seat->id] = $seat->number;
                }
            }

            return response()->json($seats_array);
        }
    }

    public function GetSeatsBuses(Request $request)
    {
        if ($request->ajax()){
            $seats = DB::table('buses')->join('seats','buses.id','=','seats.bus_id')
                ->where('buses.id',$request->bus_id)
                ->select('seats.id','seats.number','seats.status')->get();

            foreach ($seats as $seat) {
                if ($seat->status == 1){
                    $seats_array[$seat->id] = "<span class='badge badge-success'>$seat->number</span>";
                }else{
                    $seats_array[$seat->id] = "<span class='badge badge-danger'>$seat->number</span>";
                }
            }

            return response()->json($seats_array);
        }
    }

    public function PriceTotal(Request $request)
    {
        if ($request->ajax()){
            $number = count($request->seats);
            $price = $request->subtotal;

            $total_array =[$price , $number];

            return response()->json($total_array);
        }
    }
}
