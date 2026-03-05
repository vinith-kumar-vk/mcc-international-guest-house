<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Models\Booking;

Route::get('/', function () {
    return view('index');
})->name('home');

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

// Admin Dashboard to see database data visually
Route::get('/admin/bookings', function () {
    $bookings = Booking::orderBy('created_at', 'desc')->get();
    return view('admin_bookings', compact('bookings'));
})->name('admin.bookings');
