<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\PendingController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\DashboardController;

// HOME PAGE
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//HOME BOOKING ---------------------------------------------------------------------------
Route::get('/booking/add_book', function () {
    return view('booking.add_book');
})->name('add_book');




//LOGIN
Route::get('/login/login', function () {
    return view('login.login');
})->name('login');
Route::post('/login/login', [AuthController::class, 'loginPost'])->name('login.post');

//SIGNUP
Route::get('/login/signup', function () {
    return view('login.signup');
})->name('signup');
Route::post('/login/signup', [AuthController::class, 'registrationPost'])->name('signup.post');

//ADMIN ---------------------------------------------------------------------------
Route::get('/admin/admin', [DashboardController::class, 'view'])->name('admin');

//ADMIN BOOKING ---------------------------------------------------------------------------
Route::get('/admin/booking/list', [BookingController::class, 'view'])->name('admin.list');

Route::get('/admin/booking/to_arrive', [BookingController::class, 'viewArrive'])->name('admin.arrive');
Route::post('/admin/booking/checkin/{id}', [BookingController::class, 'checkIn'])->name('admin.checkin');

Route::get('/admin/booking/to_depart', [BookingController::class, 'viewDepart'])->name('admin.depart');
Route::post('/admin/booking/checkout/{id}', [BookingController::class, 'checkOut'])->name('admin.checkout');

Route::get('delete/addons/{id}', [BookingController::class, ('deleteAddons')])->name('admin.addons');

//ADD BOOKING
Route::get('/admin/booking/add_book', function () {
    return view('admin.booking.add_book');
})->name('admin.add_book');
Route::post('/admin/booking/add_book', [BookingController::class, 'addBooking'])->name('admin.add_book.post');

//PENDING BOOKING
Route::get('/check/room/{id}', [PendingController::class, ('checkRoomsAvailability')])->name('admin.check_room');
Route::get('/admin/confirm_booking/pending', [PendingController::class, 'view'])->name('admin.pending');
Route::post('payment/{id}', [PendingController::class, ('payment')])->name('admin.payment');
Route::post('reject/{id}', [PendingController::class, ('reject')])->name('admin.reject');

//EDIT BOOKING
Route::get('edit_booking/{id}', [BookingController::class, 'editView'])->name('admin.edit_book');

Route::put('pending.update/{id}', [BookingController::class, 'pendingUpdate'])->name('admin.update');
Route::get('confirmed.update/{id}', [BookingController::class, 'editView'])->name('admin.edit_book');

//BOOKING VALIDATION

Route::get('/rooms/check', [ValidationController::class, ('fetchDate')])->name('fetchData');
Route::get('/room/{name}', [ValidationController::class, ('fetchData')])->name('fetchData');

//BOOKING PDF
Route::get('/pdf/{id}', [PDFController::class, ('bookingPDF')])->name('booking.pdf');
Route::get('/admin/booking/pdf', [PDFController::class, ('view')])->name('admin.pdf');

//ROOMS ---------------------------------------------------------------------------
Route::get('/admin/rooms/add_room', [ChartController::class, ('addView')])->name('rooms.add_room');
Route::post('/admin/rooms/add_room', [ChartController::class, ('addChart')])->name('add_chart.post');


Route::get('/admin/rooms/room_chart', [ChartController::class, ('view')])->name('rooms.room_chart');
Route::get('/search/date', [ChartController::class, ('dateQuery')])->name('chart.date');
Route::put('/rooms/list/{id}', [ChartController::class, ('fetchBookings')])->name('view.booking');

Route::get('/admin/rooms/room_type', [RoomController::class, ('view')])->name('rooms.room_type');
Route::get('/rooms/update/{id}', [RoomController::class, ('editView')])->name('room_type.edit');
Route::put('/rooms/update/{id}', [RoomController::class, ('update')])->name('room_type.update');
Route::post('/admin/rooms/add_room_type', [RoomController::class, ('addRoom')])->name('room_type.post');

//MEALS ---------------------------------------------------------------------------
Route::post('/admin/rooms/add_meals', [RoomController::class, ('addMeals')])->name('add_meals.post');
Route::get('/meals/delete/{id}', [RoomController::class, ('delete')])->name('meals.delete');


//REPORTS ---------------------------------------------------------------------------
Route::get('/admin/reports/list', function () {
    return view('admin.reports.list');
})->name('reports.list');

Route::get('/admin/reports/booking', function () {
    return view('admin.reports.booking');
})->name('reports.booking');

//ACCOUNTS ---------------------------------------------------------------------------

//ADMIN - ACCOUNTS ---------------------------------------------------------------------------
Route::get('/admin/accounts/admin_account/add_account', function () {
    return view('admin.accounts.admin_account.add_account');
})->name('admin_account.add_account');

Route::get('/admin/accounts/admin_account/list', function () {
    return view('admin.accounts.admin_account.list');
})->name('admin_account.list');

//USER - ACCOUNTS ---------------------------------------------------------------------------
Route::get('/admin/accounts/user_account/add_account', function () {
    return view('admin.accounts.user_account.add_account');
})->name('user_account.add_account');

Route::get('/admin/accounts/user_account/list', function () {
    return view('admin.accounts.user_account.list');
})->name('user_account.list');


//EMPLOYEE - ACCOUNTS ---------------------------------------------------------------------------
Route::get('/admin/accounts/employee_account/add_account', function () {
    return view('admin.accounts.employee_account.add_account');
})->name('employee_account.add_account');

Route::get('/admin/accounts/employee_account/list', function () {
    return view('admin.accounts.employee_account.list');
})->name('employee_account.list');