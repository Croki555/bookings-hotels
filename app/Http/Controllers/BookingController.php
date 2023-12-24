<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', auth('web')->user()->id)->get();
        return view('bookings.index', [
            'bookings' => $bookings
        ]);
    }

    public function store(Request $request, int $id)
    {
        $room = Room::find($id);

        $bookings = new Booking();
        $bookings->room_id = $request->room_id;
        $bookings->user_id = auth('web')->user()->id;
        $bookings->started_at = $request->started_at;
        $bookings->finished_at = $request->finished_at;
        $bookings->days = 1;
        $bookings->price = $room->price;
        $bookings->save();

        return redirect(route('bookings.index'));
    }

    public function show(int $id)
    {
        $booking = Booking::find($id);
        return view('bookings.show', [
            'booking'=> $booking
        ]);
    }
}
