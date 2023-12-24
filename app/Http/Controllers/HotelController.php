<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        $hotelPrice = 0;
        foreach ($hotels as $hotel){
            $room = Room::where('hotel_id', $hotel->id)->avg('price');
            $hotelPrice = round($room);
        }
        return view('hotels.index', [
            'hotels' => $hotels,
            'hotelPrice' =>  $hotelPrice
        ]);
    }


    public function show(int $id, Request $request)
    {
        if($request->query('start_date') && $request->query('end_date')) {
            $hotel = Hotel::find($id);
            $rooms = Room::where('hotel_id', $id)->whereBetween('updated_at', [$request->start_date, $request->end_date])->get();
        }else {
            $hotel = Hotel::find($id);
            $rooms = Room::where('hotel_id', $id)->get();
        }

        return view('hotels.show', [
            'hotel' => $hotel,
            'rooms' => $rooms
        ]);
    }
}
