<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Availability;
use App\Models\Leave;

class CounsellorController extends Controller
{
    public function dashboard()
    {
        return redirect()->route('counsellor.bookings');
    }

    public function bookings()
    {
        $bookings = Booking::with('user')->where('counsellor_id', Auth::id())->orderBy('date')->orderBy('start_time')->get();
        return view('counsellor.bookings', compact('bookings'));
    }

    public function availabilities()
    {
        $availabilities = Availability::where('counsellor_id', Auth::id())->orderBy('day_of_week')->get();
        return view('counsellor.availabilities', compact('availabilities'));
    }

    public function leaves()
    {
        $leaves = Leave::where('counsellor_id', Auth::id())->orderBy('date', 'desc')->get();
        return view('counsellor.leaves', compact('leaves'));
    }

    public function storeAvailability(Request $request)
    {
        $request->validate([
            'day_of_week' => 'required|integer|min:0|max:6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $overlap = Availability::where('counsellor_id', Auth::id())
            ->where('day_of_week', $request->day_of_week)
            ->where(function ($query) use ($request) {
                $query->where('start_time', '<', $request->end_time)
                      ->where('end_time', '>', $request->start_time);
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['availability' => 'This time slot overlaps with an existing availability.'])->withInput();
        }

        Availability::create([
            'counsellor_id' => Auth::id(),
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return back()->with('success', 'Availability added.');
    }

    public function destroyAvailability(Availability $availability)
    {
        if ($availability->counsellor_id !== Auth::id()) abort(403);
        $availability->delete();
        return back()->with('success', 'Availability deleted.');
    }

    public function storeLeave(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'reason' => 'nullable|string|max:255',
        ]);

        Leave::create([
            'counsellor_id' => Auth::id(),
            'date' => $request->date,
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Leave added.');
    }

    public function destroyLeave(Leave $leave)
    {
        if ($leave->counsellor_id !== Auth::id()) abort(403);
        $leave->delete();
        return back()->with('success', 'Leave/Exception deleted.');
    }

    public function acceptBooking(Booking $booking)
    {
        if ($booking->counsellor_id !== Auth::id()) abort(403);
        $booking->update(['status' => 'accepted']);
        
        $booking->load('user');
        \Illuminate\Support\Facades\Log::info("Message to User ({$booking->user->name} / {$booking->user->phone}): Your booking on {$booking->date} at {$booking->start_time} has been accepted by " . Auth::user()->name . ".");
        
        return back()->with('success', 'Booking accepted.');
    }

    public function cancelBooking(Request $request, Booking $booking)
    {
        if ($booking->counsellor_id !== Auth::id()) abort(403);
        
        $request->validate(['cancellation_reason' => 'required|string']);
        
        $booking->update([
            'status' => 'cancelled',
            'cancellation_reason' => $request->cancellation_reason
        ]);
        
        $booking->load('user');
        \Illuminate\Support\Facades\Log::info("Message to User ({$booking->user->name} / {$booking->user->phone}): Your booking on {$booking->date} at {$booking->start_time} was cancelled by counsellor " . Auth::user()->name . ". Reason: {$request->cancellation_reason}");
        
        return back()->with('success', 'Booking cancelled.');
    }

    public function completeBooking(Booking $booking)
    {
        if ($booking->counsellor_id !== Auth::id()) abort(403);
        
        $booking->update(['status' => 'completed']);
        
        return back()->with('success', 'Booking marked as completed.');
    }
}
