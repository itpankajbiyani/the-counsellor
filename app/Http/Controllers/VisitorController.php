<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function index()
    {
        $counsellors = User::where('role', 'counsellor')->get();
        $blogs = \App\Models\Blog::latest()->take(3)->get();
        $testimonials = \App\Models\Testimonial::latest()->take(3)->get();
        return view('home', compact('counsellors', 'blogs', 'testimonials'));
    }

    public function showBlog(\App\Models\Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    public function show(User $user)
    {
        if ($user->role !== 'counsellor') abort(404);
        
        $user->load(['availabilities', 'leaves']);
        
        // Generate slots for the next 14 days
        $slots = [];
        $bookings = Booking::where('counsellor_id', $user->id)
            ->where('date', '>=', Carbon::today())
            ->where('status', '!=', 'cancelled')
            ->get();
            
        for ($i = 0; $i < 14; $i++) {
            $date = Carbon::today()->addDays($i);
            $dateString = $date->format('Y-m-d');
            
            // Skip if on leave
            if ($user->leaves->where('date', $dateString)->count() > 0) continue;
            
            $dayOfWeek = $date->dayOfWeek;
            $dayAvailabilities = $user->availabilities->where('day_of_week', $dayOfWeek);
            
            foreach ($dayAvailabilities as $avail) {
                $start = Carbon::parse($avail->start_time);
                $end = Carbon::parse($avail->end_time);
                
                while ($start->copy()->addMinutes(50) <= $end) {
                    $slotStart = $start->format('H:i:s');
                    $slotEnd = $start->copy()->addMinutes(50)->format('H:i:s');
                    
                    // Check if booked (handling overlap)
                    $isBooked = $bookings->where('date', $dateString)
                        ->filter(function($b) use ($slotStart, $slotEnd) {
                            return $b->start_time < $slotEnd && $b->end_time > $slotStart;
                        })
                        ->count() > 0;
                        
                    $slots[$dateString][] = [
                        'start' => $slotStart,
                        'end' => $slotEnd,
                        'booked' => $isBooked
                    ];
                    
                    $start->addHour();
                }
            }
        }

        return view('counsellor.show', compact('user', 'slots'));
    }

    public function book(Request $request)
    {
        $request->validate([
            'counsellor_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'message' => 'required|string|max:1000',
            'name' => 'nullable|string|max:255',
        ]);
        
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'counsellor') {
            return back()->withErrors(['slot' => 'Admins and Counsellors cannot book sessions.']);
        }
        
        if (Auth::user()->role === 'user') {
            $hasActiveBooking = Booking::where('user_id', Auth::id())
                ->whereIn('status', ['pending', 'accepted'])
                ->exists();
                
            if ($hasActiveBooking) {
                return back()->withErrors(['slot' => 'You already have an active session (pending or accepted). Please complete or cancel it before booking a new one.']);
            }
        }
        
        if ($request->filled('name')) {
            $user = Auth::user();
            $user->name = $request->name;
            $user->save();
        }
        
        // Check if slot is already booked (handling overlap)
        $exists = Booking::where('counsellor_id', $request->counsellor_id)
            ->where('date', $request->date)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($request) {
                $query->where('start_time', '<', $request->end_time)
                      ->where('end_time', '>', $request->start_time);
            })
            ->exists();
            
        if ($exists) {
            return back()->withErrors(['slot' => 'This slot is already booked.']);
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'counsellor_id' => $request->counsellor_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'pending',
            'message' => $request->message,
        ]);
        
        $counsellor = User::find($request->counsellor_id);
        if ($counsellor) {
            \Illuminate\Support\Facades\Log::info("Message to Counsellor ({$counsellor->name}): You have a new booking request from " . Auth::user()->name . " on {$request->date} at {$request->start_time}.");
        }

        return redirect()->route('user.dashboard')->with('success', 'Booking requested successfully.');
    }

    public function dashboard()
    {
        $bookings = Booking::with('counsellor')->where('user_id', Auth::id())->orderBy('date', 'desc')->get();
        return view('user.dashboard', compact('bookings'));
    }

    public function cancelBooking(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) abort(403);
        if (in_array($booking->status, ['pending', 'accepted'])) {
            $request->validate(['cancellation_reason' => 'required|string']);
            
            $booking->update([
                'status' => 'cancelled',
                'cancellation_reason' => $request->cancellation_reason
            ]);
            
            $booking->load('counsellor');
            \Illuminate\Support\Facades\Log::info("Message to Counsellor ({$booking->counsellor->name}): The booking on {$booking->date} at {$booking->start_time} was cancelled by user " . Auth::user()->name . ". Reason: {$request->cancellation_reason}");
            
            return back()->with('success', 'Booking cancelled successfully.');
        }
        return back()->withErrors(['error' => 'Cannot cancel this booking.']);
    }
}
