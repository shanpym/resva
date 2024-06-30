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
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AppearanceController;



use App\Http\Middleware\RoleMiddleware;
// HOME PAGE
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/', [AppearanceController::class, 'welcomeView'])->name('home');


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

//ADMIN LOGIN

Route::get('admin', function () {
    return view('admin');
})->name('login.admin');
Route::post('admin', [AuthController::class, 'adminPost'])->name('admin_login.post');

//SIGNUP
Route::get('/login/signup', function () {
    return view('login.signup');
})->name('signup');
Route::post('/login/signup', [AuthController::class, 'registrationPost'])->name('signup.post');

//ADMIN ---------------------------------------------------------------------------
Route::get('/admin/admin', [DashboardController::class, 'view'])->name('admin')->middleware(RoleMiddleware::class);

//ADMIN BOOKING ---------------------------------------------------------------------------
Route::get('/admin/booking/list', [BookingController::class, 'view'])->name('admin.list')->middleware(RoleMiddleware::class);

Route::get('/admin/booking/to_arrive', [BookingController::class, 'viewArrive'])->name('admin.arrive')->middleware(RoleMiddleware::class);
Route::post('/admin/booking/checkin/{id}', [BookingController::class, 'checkIn'])->name('admin.checkin')->middleware(RoleMiddleware::class);

Route::get('/admin/booking/to_depart', [BookingController::class, 'viewDepart'])->name('admin.depart')->middleware(RoleMiddleware::class);
Route::post('/admin/booking/checkout/{id}', [BookingController::class, 'checkOut'])->name('admin.checkout')->middleware(RoleMiddleware::class);

Route::get('delete/addons/{id}', [BookingController::class, ('deleteAddons')])->name('admin.addons')->middleware(RoleMiddleware::class);

//ADD BOOKING
Route::get('/admin/booking/add_book', function () {
    return view('admin.booking.add_book');
})->name('admin.add_book')->middleware(RoleMiddleware::class);
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

//BOOKING MAIL
Route::get('admin/mail', [MailController::class, 'index']);


//GUEST BOOKING
Route::get('booking/add_book', function () {
    return view('booking.add_book');
})->name('add_book');
Route::post('/booking/add_book', [BookingController::class, 'addBooking'])->name('admin.add_book.post');

//GUEST PAYMENT

Route::get('/admin/confirm_booking/guest_payment/{id}', [PendingController::class, ('guestView')])->name('admin.guest_payment');
Route::post('guest_payment/{id}', [PendingController::class, ('guestPayment')])->name('admin.guest_payment');
Route::post('/booking/add_book', [BookingController::class, 'guestaddBooking'])->name('guest.add_book.post');

//ROOMS ---------------------------------------------------------------------------
Route::get('/admin/rooms/add_room', [ChartController::class, ('addView')])->name('rooms.add_room')->middleware(RoleMiddleware::class);
Route::post('/admin/rooms/add_room', [ChartController::class, ('addChart')])->name('add_chart.post')->middleware(RoleMiddleware::class);


Route::get('/admin/rooms/room_chart', [ChartController::class, ('view')])->name('rooms.room_chart')->middleware(RoleMiddleware::class);
Route::get('/search/date', [ChartController::class, ('dateQuery')])->name('chart.date');
Route::put('/rooms/list/{id}', [ChartController::class, ('fetchBookings')])->name('view.booking')->middleware(RoleMiddleware::class);
Route::get('/admin/rooms/list/', [ChartController::class, ('viewRooms')])->name('view.rooms')->middleware(RoleMiddleware::class);
Route::put('/delete/room/{id}', [ChartController::class, ('delete')])->name('delete.rooms')->middleware(RoleMiddleware::class);
Route::put('/update/room/{id}', [ChartController::class, ('update')])->name('update.rooms')->middleware(RoleMiddleware::class);

Route::get('/admin/rooms/room_type', [RoomController::class, ('view')])->name('rooms.room_type')->middleware(RoleMiddleware::class);
Route::get('/rooms/update/{id}', [RoomController::class, ('editView')])->name('room_type.edit')->middleware(RoleMiddleware::class);
Route::put('/rooms/update/{id}', [RoomController::class, ('update')])->name('room_type.update')->middleware(RoleMiddleware::class);
Route::post('/admin/rooms/add_room_type', [RoomController::class, ('addRoom')])->name('room_type.post')->middleware(RoleMiddleware::class);

//MEALS ---------------------------------------------------------------------------
Route::post('/admin/rooms/add_meals', [RoomController::class, ('addMeals')])->name('add_meals.post')->middleware(RoleMiddleware::class);
Route::get('/meals/delete/{id}', [RoomController::class, ('delete')])->name('meals.delete')->middleware(RoleMiddleware::class);


//REPORTS ---------------------------------------------------------------------------
Route::get('/admin/reports/list', function () {
    return view('admin.reports.list');
})->name('reports.list')->middleware(RoleMiddleware::class);

Route::get('/admin/reports/booking', [ReportController::class, ('view')])->name('reports.booking')->middleware(RoleMiddleware::class);

Route::get('/filter/reports', [ReportController::class, ('filter')])->name('reports.filter')->middleware(RoleMiddleware::class);
// Route::post('/admin/reports/booking',[ReportController::class, ('reportQuery')])->name('reports.post')->middleware(RoleMiddleware::class);

// Route::get('/reports/pdf', [PDFController::class, ('reportPDF')])->name('reports.pdf');
Route::post('admin/reports/booking', [PDFController::class, ('reportPDF')])->name('reports.pdf');
// Route::get('/reports/pdf', function () {
//     return view('admin.reports.pdf');
// })->name('reports.pdf')->middleware(RoleMiddleware::class);

//ACCOUNTS ---------------------------------------------------------------------------

//ADMIN - ACCOUNTS ---------------------------------------------------------------------------
Route::get('/admin/accounts/admin_account/add_account', function () {
    return view('admin.accounts.admin_account.add_account');
})->name('admin_account.add_account');

Route::get('/admin/profile', [AdminController::class, 'profileView'])->name('admin.profile');

Route::get('/admin/accounts/admin_account/list', [AdminController::class, ('view')])->name('admin_account.list')->middleware(RoleMiddleware::class);
Route::post('/admin/accounts/admin_account/post', [AdminController::class, ('accountPost')])->name('admin_account.post')->middleware(RoleMiddleware::class);
Route::get('/admin/accounts/admin_account/{id}', [AdminController::class, ('editView')])->name('admin_account.edit')->middleware(RoleMiddleware::class);
Route::put('update/{id}', [AdminController::class, ('update')])->name('admin_account.update');
Route::put('profile/password/{id}', [AdminController::class, ('profilePassword')])->name('admin_account.password');
Route::put('password/{id}', [AdminController::class, ('password')])->name('admin_account.password');

Route::post('deactivate/{id}', [AdminController::class, ('deactivate')])->name('admin_account.deactivate');
Route::post('activate/{id}', [AdminController::class, ('activate')])->name('admin_account.activate');


//EMPLOYEE - ACCOUNTS ---------------------------------------------------------------------------
Route::get('/admin/accounts/employee_account/add_account', function () {
    return view('admin.accounts.employee_account.add_account');
})->name('employee_account.add_account');

Route::get('/admin/accounts/employee_account/list',  [AdminController::class, ('employeeView')])->name('employee_account.list');


//USER - ACCOUNTS ---------------------------------------------------------------------------
Route::get('/admin/accounts/user_account/add_account', function () {
    return view('admin.accounts.user_account.add_account');
})->name('user_account.add_account');

Route::get('/admin/accounts/user_account/list',  [AdminController::class, ('userView')])->name('user_account.list');

//USER - BOOKING 
Route::get('/user/profile', [UserController::class, 'editView'])->name('user');
Route::get('/user/booking/list', [BookingController::class, 'view'])->name('user.list');

//ADD BOOKING
Route::get('/user/booking/add_book', function () {
    return view('user.booking.add_book');
})->name('user.add_book');
Route::post('/user/booking/add_book', [BookingController::class, 'addBooking'])->name('user.add_book.post');

//PENDING BOOKING
Route::get('/user/confirm_booking/pending', [PendingController::class, 'view'])->name('user.pending');

//REVIEW
Route::get('/user/review/all_review', function () {
    return view('user.review.all_review');
})->name('user.all_review');

//WRITE REVIEW
Route::get('/user/review/write', function () {
    return view('user.review.write');
})->name('user.write');


//APPEARANCE
// Route::get('/admin/appearance/edit', function () {
//     return view('admin.appearance.edit');
// })->name('admin.edit');

Route::get('/admin/appearance/edit', [AppearanceController::class, 'view'])->name('admin.edit');
Route::post('/admin/appearance/edit', [AppearanceController::class, 'update'])->name('appearance.post');