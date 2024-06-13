<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\Booking;
use App\Models\Availability;
use App\models\Subcategorysession;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingNotification;




class UserController extends Controller
{
    //detail
    public function detail(Subcategory $subcategory)
    {
        $users = User::all();
        return view('detail', compact('subcategory', 'users'));
    }
    public function createbook(Request $request, Subcategory $subcategory)
    {
        //dd($request->all());
        //DB::enableQueryLog();
        // dd(DB::getQueryLog());
        try {
            $request->validate([
                
                'phone_no' => 'required|numeric|digits_between:8,8',  
            ]);
            $status = 'pending'; 
            $subcategory = Subcategory::find($request->subcategory_id);
            if ($subcategory && $subcategory->method === 'auto') {
                $status = 'booked'; 
            }
            $time = explode(',', $request->time); 

            Booking::create([
                'user_id' => Auth::id(),
                'subcategory_id' => $request->subcategory_id,
                'start_date' => $request->start_date,
                'start_time' => $time[0],
                'end_time' => $time[1],
                'additional_requirement' => $request->additional_requirement,
                'phone_no' => $request->phone_no,
                'reason' => $request->reason,
                'status' => $status,
            ]);
    
            $admins = User::where('role', 'admin')->get(); // Fetch all admins (adjust the condition based on your user structure)
        
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new BookingNotification($request->user()->name, $request->user()->email, $subcategory->facility_name));
            }
            return redirect()->route('subcategory.detail', ['subcategory' => $request->subcategory_id])->with('success', 'Successfully Booked');        
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error creating facility: ' . $e->getMessage());
    
            // Redirect with an error message
           
            return redirect()->route('subcategory.detail', ['subcategory' => $request->subcategory_id])->with('error', 'Failed to booked');
        }
    }

    public function ugetSubcategorySession($id)
    {
        date_default_timezone_set('Asia/Thimphu');
        $currentDate = date("Y-m-d");
        // Fetch the subcategory session dates based on the subcategory ID
        $subcategory = Subcategory::findOrFail($id);

        if ($subcategory->subcategorysession) {
            $start_date = $subcategory->subcategorysession->start_date;
            $end_date = $subcategory->subcategorysession->end_date;

            return response()->json([
                'currentDate' => $currentDate,
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]);
        }

        return response()->json([
            'error' => 'Subcategory session not found.',
        ], 404);
    }
    
    public function ugetSubcategorySessiont(Request $request, $subfacilityId)
    {
        // Fetch the subcategory session dates based on the subcategory ID
        $subcategory = Subcategory::findOrFail($subfacilityId);
        $startDate = $request->query('start_date');
    
        // Initialize session start and end times to null
        $sessionStartTime = null;
        $sessionEndTime = null;
    
        // Check if subcategory session exists and retrieve session start and end times
        if ($subcategory->subcategorysession) {
            $sessionStartTime = $subcategory->subcategorysession->start_time;
            $sessionEndTime = $subcategory->subcategorysession->end_time;
        }
    
        // Filter Booking model based on subcategory_id and date range
        $bookings = Booking::where('subcategory_id', $subfacilityId)
            ->where('start_date', $startDate)
            ->get();
    
        // Filter Availability model based on subcategory_id and date range
        $availabilities = Availability::where('subcategory_id', $subfacilityId)
            ->where('start_date', $startDate)
            ->get();

        $bookingStartTimes = $bookings->pluck('start_time')->toArray();
        $bookingEndTimes = $bookings->pluck('end_time')->toArray();
    
        $availabilityStartTimes = $availabilities->pluck('start_time')->toArray();
        $availabilityEndTimes = $availabilities->pluck('end_time')->toArray();

        $slot = $subcategory->slot;
        $bhutanTime = new \DateTime('now', new \DateTimeZone('Asia/Thimphu'));
        $bhutanCurrentTime = $bhutanTime->format('Y-m-d H:i:s');
    
        $response = [
            'session_start_time' => $sessionStartTime,
            'session_end_time' => $sessionEndTime,
            'booking_start_times' => $bookingStartTimes,
            'booking_end_times' => $bookingEndTimes,
            'availability_start_times' => $availabilityStartTimes,
            'availability_end_times' => $availabilityEndTimes,
            'slot' => $slot,
            'bhutan_current_time' => $bhutanCurrentTime,
        ];
    
        return response()->json($response);
    }
    //mybooking
    public function mybooking()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)->get();
        return view('mybooking', compact('bookings'));
    }
    public function mybookingdelte($id){
        try {
            $booking = Booking::findOrFail($id);
            $booking->delete();
            return response()->json(['success' => true, 'message' => 'Booking cancel successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting booking', 'error' => $e->getMessage()]);
        }
    }

    //booknow
    public function booknow()
    {
        $categories = Category::all();
        $currentTime = now()->timezone('Asia/Thimphu'); // Replace 'Asia/Thimphu' with Bhutan's timezone

        // Filter subcategories based on conditions
        $subcategories = Subcategory::whereHas('subcategorysession', function ($query) use ($currentTime) {
            // Filter out subcategories where the end_date is over
            $query->whereDate('end_date', '>=', $currentTime->format('Y-m-d'))
                  ->whereTime('end_time', '>=', $currentTime->format('H:i:s'));
        })
        ->where('ed', '!=', 'disable') // Filter out subcategories with ed not equal to 'disable'
        ->get();
        return view('booknow', compact('subcategories', 'categories'));
    }
    public function userprofile()
    {
        $user = Auth::user();
        return view('userprofile',compact('user'));
    }
}
