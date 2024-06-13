<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Psy\TabCompletion\AutoCompleter;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\Booking;
use App\Models\Availability;
use App\Models\Subcategorysession;
use App\Models\Usertype;
use App\Models\Team;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedWithPassword;
use App\Mail\BookingRejectionMail;
use App\Mail\BookingConfirmationMail;
use Maatwebsite\Excel\Facades\Excel;




class AdminController extends Controller
{

    // dashboard--------------------------------------------------------
    public function dashboard()
    {
        $categorycount = Category::count();
        $categories = Category::all();
        $subcategorycount = Subcategory::count();
        $bookings = Booking::all();
        $bookingcount = Booking::count();
        $usercount = User::count();
        $bookingData = Booking::with('subcategory:id,facility_name')
        ->select('subcategory_id', DB::raw('COUNT(*) as count'))
        ->groupBy('subcategory_id')
        ->get();
        $categor = Category::withCount('subcategories')->get();
        $userCounts = User::select('usertype_id', DB::raw('COUNT(*) as count'))
        ->groupBy('usertype_id')
        ->get();
        $userTypes = Usertype::pluck('type', 'id')->toArray();
    
        return view('admin.dashboard',['bookingData' => $bookingData], compact('categorycount', 'categories', 'subcategorycount', 'bookings', 'bookingcount', 'usercount','categor','userCounts','userTypes'));
    }
    
    // category-------------------------------------------------------------
    public function category()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.category', compact('categories', 'subcategories'));
    }
    public function createfacility(Request $request)
    {
        // dd($request->all());
        // DB::enableQueryLog();
        // dd(DB::getQueryLog());
        try {
            $request->validate([
                'category_name' => ['required', 'string', 'max:255', 'unique:categories'], 
                'description' => ['required', 'string', 'max:255'],
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
    
            $category = Category::where('category_name', $request->category_name)->first();
        
            if ($category) {
                return redirect()->route('admin.category')->with('error', 'This category is already created!');
            }
    
            $imagePath = $request->file('image')->store('public/images'); 
            Category::create([
                'category_name' => $request->category_name,
                'description' => $request->description,
                'image' => $imagePath, // Store the image path in the database
            ]);
            return redirect()->route('admin.category')->with('success', 'Category has been created');
        }catch (\Exception $e) {
            // dd($e->getMessage());
            // Log::error('Error creating category: ' . $e->getMessage());
            return redirect()->route('admin.category')->with('error', 'Failed to create category');
        }
    }
    public function categorydelete(Request $request)
    {
        $categoryIds = $request->input('categoryIds');
    
        try {
            // Use the Category model to delete categories by IDs
            Category::whereIn('id', $categoryIds)->delete();
    
            return response()->json(['success' => true, 'message' => 'Categories deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting categories']);
        }
    }

    public function updateCategory(Request $request, $id)
    {
    try {
        $category = Category::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete existing image (optional)
            // Storage::disk('public')->delete($category->image);

            // Store the new image
            $category->image = $request->file('image')->store('images', 'public');
        }

        // Update other fields
        $category->update($request->except('image'));

        return redirect()->route('admin.category')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.category')->with('error', 'Error updating category');
        }
    }

    //session-------------------------------------------------------------
    public function session(){
        $subcategorysessions = Subcategorysession::all();
        return view('admin.session', compact('subcategorysessions'));
    }
    public function createsession(Request $request){
        // dd($request->all());
        $request->validate([
            
            // 'usertype' => ['required', 'string', 'max:255'],
            // 'role' => ['required', 'integer', 'max:255'],
            // 'password' => ['required', Rules\Password::defaults()],
        ]);
        $startd = Subcategorysession::where('start_date', $request->start_date)->first();
        $endd = Subcategorysession::where('end_date', $request->end_date)->first();
        $startt = Subcategorysession::where('start_time', $request->start_time)->first();
        $endt = Subcategorysession::where('end_time', $request->end_time)->first();

        if ($startd && $endd && $startt && $endt) {
            // Subcategory already exists, show an error message
            return redirect()->route('admin.session')->with('error', 'This sessio already exist!');
        }
    
        // Create the user
        $session = Subcategorysession::create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
        return redirect()->route('admin.session')->with('success', 'Session is successfully added.');
    }
    public function sessiondelete(Request $request)
    {
        $categoryIds = $request->input('categoryIds');
    
        try {
            // Use the Category model to delete categories by IDs
            Subcategorysession::whereIn('id', $categoryIds)->delete();
    
            return response()->json(['success' => true, 'message' => 'Categories deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting categories']);
        }
    }
    public function updateSession(Request $request, $id)
    {
    try {
        $category = Subcategorysession::findOrFail($id);

        // Update other fields
        $category->update($request->all());

        return redirect()->route('admin.session')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.session')->with('error', 'Error updating category');
        }
    }


    // facilities--------------------------------------------------------
    public function facilities()
    {
        $categories = Category::all();
        $subcategorysessions = Subcategorysession::all();
        $subcategories = Subcategory::all();
        return view('admin.facilities', compact('categories', 'subcategorysessions', 'subcategories'));
    }
    
    public function createsubfacility(Request $request)
    {
        

        try {
            // Validate the form data, including the image upload
            $request->validate([
                'facility_name' => ['required', 'string', 'max:255'],
                'category_id' => ['required', 'integer', 'exists:categories,id'],
                'subcategorysession_id' => ['required', 'integer', 'exists:subcategorysessions,id'],
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
                'resource' => ['required', 'string', 'max:255'],
            ]);
    
            // Handle the image upload and save it to a storage location
            $imagePath = $request->file('image')->store('public/images');
            // Adjust the storage location as needed
    
            // Check if the subcategory already exists
            $subcategory = Subcategory::where('facility_name', $request->facility_name)->first();
    
            if ($subcategory) {
                // Subcategory already exists, show an error message
                return redirect()->route('admin.facilities')->with('error', 'This facility is already created!');
            }

            // If the subcategory does not exist, create it
            Subcategory::create([
                'facility_name' => $request->facility_name,
                'category_id' => $request->category_id,
                'resource' => $request->resource,
                'subcategorysession_id' => $request->subcategorysession_id,
                'slot' => $request->slot,
                'method' => $request->method,
                'image' => $imagePath, // Store the image path in the database
            ]);
    
            return redirect()->route('admin.facilities')->with('success', 'Facility has been created');
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error creating facility: ' . $e->getMessage());
    
            // Redirect with an error message
            return redirect()->route('admin.facilities')->with('error', 'An error occurred while creating the facility.');
        }
    }
    public function facilitydelete(Request $request)
    {
        $categoryIds = $request->input('categoryIds');
    
        try {
            // Use the Category model to delete categories by IDs
            Subcategory::whereIn('id', $categoryIds)->delete();
    
            return response()->json(['success' => true, 'message' => 'Categories deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting categories']);
        }
    }
    public function updateFacility(Request $request, $id)
    {
    try {
        $category = Subcategory::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete existing image (optional)
            // Storage::disk('public')->delete($category->image);

            // Store the new image
            $category->image = $request->file('image')->store('images', 'public');
        }

        // Update other fields
        $category->update($request->except('image'));

        return redirect()->route('admin.facilities')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.facilities')->with('error', 'Error updating category');
        }
    }
    public function midiable(Request $request)
{
    try {
        $subcategories = explode(',', $request->input('subcategory_id')[0]);
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $reason = $request->input('reason');
        
        // Validate the form data
        $request->validate([
            // Validation rules here
        ]);
    
        foreach ($subcategories as $subcategoryId) {
            Availability::create([
                'subcategory_id' => (int)$subcategoryId, 
                'start_date' => $startDate,
                'end_date' => $endDate,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'reason' => $reason,
            ]);
        }
    
        return redirect()->route('admin.facilities')->with('success', 'Successfully Created');
    } catch (\Exception $e) {
        // Log the exception
        Log::error('Error creating facility: ' . $e);
    
        // Redirect with an error message and exception details
        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }
}
public function toggleStatus($id)
{
    $subcategory = Subcategory::findOrFail($id);

    // Toggle the status based on the current status
    if ($subcategory->ed === 'enable') {
        $subcategory->ed = 'disable';
    } else {
        $subcategory->ed = 'enable';
    }

    $subcategory->save();

    return response()->json(['message' => 'Status toggled successfully']);
}

    //availability--------------------------------------------------------------------------
    public function availability(Subcategory $subcategory){
        $availabilities = Availability::all();
        return view('admin.available',compact('availabilities', 'subcategory'));
    }
    public function createavailability(Request $request, Subcategory $subcategory)
    {
        //dd($request->all());
        // DB::enableQueryLog();
        // dd(DB::getQueryLog());
        try {
            // Validate the form data, including the image upload
            $request->validate([
                // 'additional_requirement' => ['required', 'string', 'max:255'],
                
            ]);

            // If the subcategory does not exist, create it
            Availability::create([
                'subcategory_id' => $request->subcategory_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'reason' => $request->reason,
            ]);
            return redirect()->route('subcategory.availability', ['subcategory' => $subcategory->id])->with('success', 'Successfully Create');
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error creating facility: ' . $e->getMessage());
    
            // Redirect with an error message
           
            return redirect()->route('subcategory.availability', ['subcategory' => $subcategory->id])->with('error', 'Fail to Create');
        }
    }
    public function adelete(Request $request)
    {
        $categoryIds = $request->input('categoryIds');
    
        try {
            // Use the Category model to delete categories by IDs
            Availability::whereIn('id', $categoryIds)->delete();
    
            return response()->json(['success' => true, 'message' => 'Categories deleted successfully', 'icon'=> "success"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting categories','icon'=> "error"]);
        }
    }
    public function updatea(Request $request, Subcategory $subcategory, $id)
    {
    try {
        $category = Availability::findOrFail($id);

        // Update other fields
        $category->update([
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'reason' => $request->input('reason'),
            // Add other fields you want to update
        ]);

        return redirect()->route('subcategory.availability', ['subcategory' => $subcategory->id])->with('success', 'Successfully Create');
    } catch (\Exception $e) {
            return redirect()->route('subcategory.availability', ['subcategory' => $subcategory->id])->with('success', 'Successfully Create');
        }
    }

    // user---------------------------------------------------------------------------------
    public function user()
    {

        $usertypes = Usertype::all();
        $users = User::all();
        return view('admin.user', compact('users','usertypes'));
    }
    public function createuser(Request $request)
{
    try {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'usertype_id' => ['required', 'integer', 'exists:usertypes,id'],
        ]);
        $user = User::where('email', $request->email)->first();

        if ($user) {
            return redirect()->route('admin.user')->with('error', 'This user already exists!');
        }
        $password = Str::random(10);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'usertype_id' => $request->usertype_id,
            'role' => $request->role,
            'password' => $password,
        ]);
        Mail::to($user->email)->send(new UserCreatedWithPassword($user, $password));
        return redirect()->route('admin.user')->with('success', 'User is successfully added.');
    } catch (\Exception $e) {
        return redirect()->route('admin.user')->with('error', 'Error adding user');
    }
}


public function userdelete(Request $request)
{
    $categoryIds = $request->input('categoryIds');

    try {
        // Check if there is another admin user
        $remainingAdmins = User::whereIn('id', $categoryIds)
            ->where('role', 'admin')
            ->where('id', '!=', auth()->user()->id) // Exclude the currently authenticated admin
            ->count();

        // Ensure that there is at least one admin user remaining
        $adminsCount = User::where('role', 'admin')->count();

        foreach ($categoryIds as $categoryId) {
            $user = User::find($categoryId);

            // Check if the user is an admin and if it's the last admin
            if ($user && $user->role === 'admin' && $adminsCount <= 1) {
                return response()->json(['success' => false, 'message' => 'Cannot delete the last admin', 'icon' => 'error']);
            }
        }

        // Use the User model to delete users by IDs
        User::whereIn('id', $categoryIds)->delete();

        return response()->json(['success' => true, 'message' => 'Users deleted successfully', 'icon' => 'success']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error deleting users', 'icon' => 'error', 'error' => $e->getMessage()]);
    }
}
public function deleteadmin($id)
{
    try {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Ensure it's not the last admin
        $adminsCount = User::where('role', 'admin')->count();
        if ($user->role === 'admin' && $adminsCount <= 1) {
            return response()->json(['success' => false, 'message' => 'Cannot delete the last admin', 'icon' => 'error']);
        }

        // Delete the user
        $user->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully', 'icon' => 'success']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error deleting user', 'icon' => 'error', 'error' => $e->getMessage()]);
    }
}
public function updateuser(Request $request, $id)
    {
    try {
        $category = User::findOrFail($id);

        // Update other fields
        $category->update($request->all());

        return redirect()->route('admin.user')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.user')->with('error', 'Error updating category');
        }
    }
//     public function createMultipleuser(Request $request)
// {
//     // Validate the request data
//     $request->validate([
//         'usertype_id' => 'required|exists:usertypes,id',
//         'excel_file' => 'required|mimes:xlsx,xls', // Adjust allowed file types as needed
//     ]);

//     // Read data from Excel file
//     $users = Excel::toCollection(new YourExcelImport, $request->file('excel_file'));

//     foreach ($users[0] as $user) {
//         // Generate password for each user
//         $password = Str::random(10);

//         // Save user data with passwords and usertype_id to the database
//         User::create([
//             'name' => $user['name'],
//             'email' => $user['email'],
//             'password' => bcrypt($password), // It's recommended to hash the password
//             'usertype_id' => $request->input('usertype_id'), // Save the selected usertype_id
//         ]);

//         // Send email with password
//         Mail::raw("Your password is: $password", function ($message) use ($user) {
//             $message->to($user['email'])
//                     ->subject('Your New Account Details');
//         });
//     }

//     return 'Users registered and emails sent successfully!';
// }




    //usertype-----------------------------------------------------------------------
    public function usertype()
    {
        $usertypes = Usertype::all();
        return view('admin.usertype', compact('usertypes'));
    }
    public function createusertype(Request $request)
    {
   
        $request->validate([
            'type' => ['required', 'string', 'max:255'],
        ]);
        $usertypes = Usertype::where('type', $request->email)->first();

        if ($usertypes) {
            // Subcategory already exists, show an error message
            return redirect()->route('admin.usertype')->with('error', 'This user already exist!');
        }
    
        // Create the user
        $usertypes = Usertype::create([
            'type' => $request->type,
           
        ]);
            // User creation failed, handle the error and return an error message
        return redirect()->route('admin.usertype')->with('success', 'User is successfully added.');
        
    }
    public function usertypedelete(Request $request)
    {
        $categoryIds = $request->input('categoryIds');
    
        try {
            // Use the Category model to delete categories by IDs
            Usertype::whereIn('id', $categoryIds)->delete();
    
            return response()->json(['success' => true, 'message' => 'Categories deleted successfully',  'icon' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting categories', 'icon' => 'error', 'error' => $e->getMessage()]);
        }
    }
    public function updateusertype(Request $request, $id)
    {
    try {
        $category = Usertype::findOrFail($id);

        // Update other fields
        $category->update($request->all());

        return redirect()->route('admin.usertype')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.usertype')->with('error', 'Error updating category');
        }
    }


    // booking-------------------------------------------------------------------------
    public function booking(Request $request)
    {
        $categories = Category::all();
        $bookings = Booking::orderByDesc('created_at')->Paginate(5);
        $users = Usertype::all();
        $subcategories = Subcategory::all();
        $availabilities = Availability::all();
        return view('admin.booking', compact('bookings','categories','users','subcategories', 'availabilities'));
    }
    public function createbooking(Request $request)
    {
        //dd($request->all());
        //DB::enableQueryLog();
        //dd(DB::getQueryLog());
        try {
            $request->validate([
                'additional_requirement' => ['required', 'string', 'max:255'], 
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
    
            return redirect()->route('admin.booking1')->with('success', 'Successfully Booked');        
        } catch (\Exception $e) {
            Log::error('Error creating facility: ' . $e->getMessage());   
            return redirect()->route('admin.booking1')->with('error', 'Failed to booked' . $e->getMessage());
        }
    }
    
    public function bookingConfirm(Request $request, $id)
    {
        try {
            // $id corresponds to the {id} parameter in the route
            $status = 'booked';
            $booking = Booking::findOrFail($id);
           
            // Update other fields
            $booking->update([
                'status' => $status,
                // Other fields to update can be added here
            ]);    
            $user = $booking->user; // Assuming there's a user associated with the booking
            $emailContent = 'Your booking has been confirmed. Thank you!'; // Customize email content
            Mail::to($user->email)->send(new BookingConfirmationMail($emailContent));
            
            return response()->json([
                'success' => true, 
                'message' => 'Booking status updated successfully',  
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Error updating booking status', 
                'icon' => 'error', 
                'error' => $e->getMessage()
            ]);
        }
    }
    public function bookingDelete($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $userEmail = $booking->user->email;
            $booking->delete();
            $reason = request()->input('rejectionReason');
            Mail::to($userEmail)->send(new BookingRejectionMail($reason));
            return response()->json(['success' => true, 'message' => 'Booking deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting booking', 'error' => $e->getMessage()]);
        }
    }

    
    public function getSubcategorySession($id)
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
    
    public function getSubcategorySessiont(Request $request, $subfacilityId)
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
    
        // // Filter Availability model based on subcategory_id and date range
        // $availabilities = Availability::where('subcategory_id', $subfacilityId)
        //     ->where('start_date', $startDate)
        //     ->get();

        $bookingStartTimes = $bookings->pluck('start_time')->toArray();
        // $bookingEndTimes = $bookings->pluck('end_time')->toArray();
    
        // $availabilityStartTimes = $availabilities->pluck('start_time')->toArray();
        // $availabilityEndTimes = $availabilities->pluck('end_time')->toArray();

        $slot = $subcategory->slot;
        $bhutanTime = new \DateTime('now', new \DateTimeZone('Asia/Thimphu'));
        $bhutanCurrentTime = $bhutanTime->format('H:i:s');
        $timeArray = array();
        $timeArray[] = $bhutanCurrentTime;
    
        $response = [
            'session_start_time' => $sessionStartTime,
            'session_end_time' => $sessionEndTime,
            'booking_start_times' => $bookingStartTimes,
            // 'booking_end_times' => $bookingEndTimes,
            // 'availability_start_times' => $availabilityStartTimes,
            // 'availability_end_times' => $availabilityEndTimes,
            'slot' => $slot,
            'bhutan_current_time' => $timeArray,
        ];
    
        return response()->json($response);
    }
    


    


    // setting------------------------------------------------------------------------
    public function setting()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.setting', compact('categories','subcategories'));
    }

    public function createteam(Request $request)
{
    try {
        // Validate the form data, including the image upload
        $request->validate([
            // Add your validation rules here
        ]);

        // Check if a team with the same subcategory_id exists
        $existingTeam = Team::where('subcategory_id', $request->subcategory_id)->first();

        if ($existingTeam) {
            // If the team exists, update the image path
            $imagePath = $request->file('image')->store('public/images');
            $existingTeam->update(['image' => $imagePath]);
        } else {
            // If the team doesn't exist, create a new entry
            $imagePath = $request->file('image')->store('public/images');
            Team::create([
                'subcategory_id' => $request->subcategory_id,
                'image' => $imagePath,
            ]);
        }

        return redirect()->route('admin.setting')->with('success', 'Facility has been created');
    } catch (\Exception $e) {
        // Log the exception
        Log::error('Error creating facility: ' . $e->getMessage());

        // Redirect with an error message
        return redirect()->route('admin.setting')->with('error', 'An error occurred while creating the facility.');
    }
}
}
