<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Models\Category;
use App\Models\Subcategory;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $categories = Category::all();
    $subcategories = Subcategory::all();
    return view('welcome', compact('categories','subcategories'));
});

Route::get('/dashboard', function () {
    $categories = Category::all();
    $subcategories = Subcategory::all();
    return view('dashboard',compact('categories','subcategories'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

///////////////////////////////////////////////////////////////////////////////////////////////
Route::middleware(['auth','role:admin'])->group(function () {
    //dashboard
    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);

    //category
    Route::get('admin/category', [AdminController::class, 'category'])->name('admin.category');
    Route::post('admin/facilities.create', [AdminController::class, 'createfacility'])->name('admin.createfacility');
    Route::delete('admin/category/delete', [AdminController::class, 'categorydelete'])->name('categories.destroy');
    Route::put('admin/category/update/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');

    //session
    Route::get('admin/session', [AdminController::class, 'session'])->name('admin.session');
    Route::post('admin/facilities.createsession', [AdminController::class, 'createsession'])->name('admin.createsession');
    Route::delete('admin/session/delete', [AdminController::class, 'sessiondelete'])->name('session.destroy');
    Route::put('admin/session/update/{id}', [AdminController::class, 'updateSession'])->name('session.update');

    //facility
    Route::get('admin/facilities', [AdminController::class, 'facilities'])->name('admin.facilities');
    Route::post('admin/facilities.subcreate', [AdminController::class, 'createsubfacility'])->name('admin.createsubfacility');
    Route::delete('admin/facilities/delete', [AdminController::class, 'facilitydelete'])->name('facility.destroy');
    Route::put('admin/facilities/update/{id}', [AdminController::class, 'updateFacility'])->name('facility.update');
    Route::post('admin/facilities/mi-diable', [AdminController::class, 'midiable'])->name('mi-diable');
    Route::put('admin/facilities/toggleStatus/{id}', [AdminController::class, 'toggleStatus']);
  

    //available
    Route::get('admin/facilities/{subcategory}', [AdminController::class, 'availability'])->name('subcategory.availability');
    Route::post('admin/facilities/{subcategory}/createavailability', [AdminController::class, 'createavailability'])->name('subcategory.createavailability');
    Route::delete('admin/facilities/adelete', [AdminController::class, 'adelete'])->name('a.destroy');
    Route::put('admin/facilities/{subcategory}/{id}', [AdminController::class, 'updatea'])->name('a.update');

    //booking
    Route::get('admin/booking', [AdminController::class, 'booking'])->name('admin.booking1');
    Route::post('admin/bookingcreate', [AdminController::class, 'createbooking'])->name('admin.createbook');
    Route::put('admin/booking/confirm/{id}', [AdminController::class, 'bookingConfirm'])->name('booking.confirm');
    Route::delete('admin/booking/delete/{id}', [AdminController::class, 'bookingDelete'])->name('booking.delete');
    Route::get('/getSubcategorySession/{id}', [AdminController::class, 'getSubcategorySession'])->name('getSubcategorySession');
    Route::get('/getSubfacilitySessiont/{subfacilityId}', [AdminController::class, 'getSubcategorySessiont'])->name('getSubcategorySessiont');



    //setting
    Route::get('admin/setting', [AdminController::class, 'setting'])->name('admin.setting');
    Route::post('admin/bookingteam', [AdminController::class, 'createteam'])->name('admin.createteam');

    //user
    Route::get('admin/user', [AdminController::class, 'user'])->name('admin.user');
    Route::post('admin/user/createuser', [AdminController::class, 'createuser'])->name('admin.createuser');
    Route::delete('admin/user/delete', [AdminController::class, 'userdelete'])->name('user.destroy');
    Route::put('admin/user/update/{id}', [AdminController::class, 'updateuser'])->name('user.update');
    Route::post('admin/user/createMultipleuser', [AdminController::class, 'createMultipleuser'])->name('admin.createMultipleuser');
    Route::delete('admin/user/deleteadmin/{id}', [AdminController::class, 'deleteadmin'])->name('deleteadmin');


    //usertype
    Route::get('admin/usertype', [AdminController::class, 'usertype'])->name('admin.usertype');
    Route::post('admin/user/createusertype', [AdminController::class, 'createusertype'])->name('admin.createusertype');
    Route::delete('admin/usertype/delete', [AdminController::class, 'usertypedelete'])->name('usertype.destroy');
    Route::put('admin/usertype/update/{id}', [AdminController::class, 'updateusertype'])->name('usertype.update');

});




Route::middleware(['auth','role:user'])->group(function () {
    //detail
    Route::get('detail/{subcategory}', [UserController::class, 'detail'])->name('subcategory.detail');
    Route::post('detail/{subcategory}/book', [UserController::class, 'createbook'])->name('subcategory.createbook');
    Route::get('/ugetSubcategorySession/{id}', [UserController::class, 'ugetSubcategorySession'])->name('ugetSubcategorySession');
    Route::get('/ugetSubfacilitySessiont/{subfacilityId}', [UserController::class, 'ugetSubcategorySessiont'])->name('ugetSubcategorySessiont');

    //mybookig
    Route::get('mybooking', [UserController::class, 'mybooking'])->name('mybooking');
    Route::delete("bookings/delete/{id}", [UserController::class, 'mybookingdelte'])->name('bookings.delete');

    //booknow
    Route::get('booknow', [UserController::class, 'booknow'])->name('booknow');
    Route::get('userprofile',[UserController::class, 'userprofile'])->name('userprofile');
   

});




