<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Seat;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buses = Bus::all();
        return view('pages.tickets.create',compact('buses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'bus_id' => 'required',
            'city_id' => 'required',
            'client' => 'required|max:50',
            'ci' => 'required|max:7',
        ]);
        $tikcet = new Ticket();
        $tikcet->bus_id = $request->bus_id;
        $tikcet->city_id = $request->city_id;
        $tikcet->client = $request->client;
        $tikcet->ci = $request->ci;
        $tikcet->quantity = count($request->seats);
        $tikcet->sub_total = $request->sub_total;
        $tikcet->total = $request->total;

        foreach ($request->seats as $number) {
            Seat::where('bus_id', [$request->bus_id])
                  ->where('number',[$number])
                  ->update(['status' => 0 ]);
        }
        $tikcet->save();

        $tickets = Ticket::join('buses','tickets.bus_id','=','buses.id')
            ->join('seats','seats.bus_id','=','buses.id')
            ->join('prices','buses.id','=','prices.bus_id')
            ->join('cities','prices.city_id','=','cities.id')
            ->where('prices.bus_id',$request->bus_id)
            ->where('prices.city_id',$request->city_id)
//            ->select('cities.name as city','prices.*','tickets.*','buses.name as bus')->first();
            ->select('cities.name as city','prices.*','tickets.total','tickets.sub_total','buses.name as bus')->first();

        return view('pages.tickets.ticket',compact('tickets'));

//        return redirect()->route('tickets.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

//    public function reports()
//    {
//        //
//    }
}
