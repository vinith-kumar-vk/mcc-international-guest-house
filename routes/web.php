<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Models\Booking;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\LoginController;

Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/register', function () { return view('register'); })->name('register');

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/standard-rooms', function () {
    return view('standard-rooms');
})->name('standard.rooms');

Route::get('/booking-form', function () {
    $roomId = request('room', '1');
    return view('booking-form', compact('roomId'));
})->name('booking.form.full');

Route::get('/advance-rooms', function () {
    return view('advance-rooms');
})->name('advance.rooms');

Route::get('/conference-rooms', function () {
    return view('conference-rooms');
})->name('conference.rooms');

Route::get('/booking', [BookingController::class, 'showBookingForm'])->name('booking.form');
Route::post('/booking', [BookingController::class, 'storeBooking'])->name('booking.store');

// Redirect to this GET route for the payment page
Route::get('/payment/{id}', function ($id) {
    $booking = Booking::findOrFail($id);
    return view('payment', compact('booking'));
})->name('payment.page');

Route::post('/booking/simulate-success/{id}', [BookingController::class, 'simulateSuccess'])->name('booking.simulate.success');
Route::post('/booking/simulate-failure/{id}', [BookingController::class, 'simulateFailure'])->name('booking.simulate.failure');

Route::get('/success', function () {
    // Show the most recently updated booking (the one just paid)
    $booking = Booking::orderBy('updated_at', 'desc')->first();
    return view('success', compact('booking'));
})->name('checkout.success');

Route::get('/failure', function () {
    return view('failure');
})->name('checkout.failure');

// Admin Auth
Route::get('/admin/login', [LoginController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('admin.login.post');
Route::post('/admin/logout', [LoginController::class, 'adminLogout'])->name('admin.logout');

// Admin Dashboard Area
use App\Http\Controllers\AdminController;

Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
    Route::get('/bookings/{id}', [AdminController::class, 'show'])->name('admin.bookings.show');
    Route::post('/bookings/{id}/approve', [AdminController::class, 'adminApprove'])->name('admin.bookings.approve');
    Route::post('/bookings/{id}/reject', [AdminController::class, 'reject'])->name('admin.bookings.reject');
    Route::delete('/bookings/{id}', [AdminController::class, 'destroy'])->name('admin.bookings.destroy');
});

// These routes are now public for one-click approval from email
Route::get('/admin/bookings/{id}/approve', [AdminController::class, 'principalApprove'])->name('admin.bookings.approve.get');
Route::get('/admin/bookings/{id}/reject', [AdminController::class, 'reject'])->name('admin.bookings.reject.get');

// SuperAdmin Auth
Route::get('/superadmin/login', [LoginController::class, 'showSuperAdminLogin'])->name('superadmin.login');
Route::post('/superadmin/login', [LoginController::class, 'superAdminLogin'])->name('superadmin.login.post');
Route::post('/superadmin/logout', [LoginController::class, 'superAdminLogout'])->name('superadmin.logout');

// SuperAdmin Area
Route::prefix('superadmin')->middleware('superadmin.auth')->group(function () {
    Route::get('/', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/settings', [SuperAdminController::class, 'settings'])->name('superadmin.settings');
    Route::post('/settings', [SuperAdminController::class, 'updateSettings'])->name('superadmin.settings.update');
});

Route::get('/approval-status', function () {
    return view('approval_status');
})->name('approval.status');

// 🎨 DESIGN PREVIEW ROUTE
Route::get('/mail-preview', function () {
    $booking = Booking::first() ?? new Booking([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '+91 9876543210',
        'room_name' => 'Premium Suite',
        'booking_date' => date('Y-m-d'),
        'start_time' => '10:00:00',
        'end_time' => '12:00:00',
        'no_of_persons' => 2,
        'total_price' => 5000
    ]);
    return new App\Mail\BookingNotification($booking);
});
