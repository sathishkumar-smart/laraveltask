<?php

use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Define the route for the homepage
Route::get('/', function () {
    return view('welcome'); // Display the welcome view
});

// Define routes for authentication
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
// Show the login form
Route::post('login', [AuthController::class, 'login']);
// Handle login form submission
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
// Handle logout and redirect to the homepage

// Define routes for loan management
Route::get('loans/fetch', [LoanController::class, 'fetch'])->name('loans.fetch');
// Fetch and display loan details
Route::get('process-data', [LoanController::class, 'viewprocessdata'])->name('processdata');
// Show the view for processing loan data
Route::get('process-data/create', [LoanController::class, 'processData'])->name('processdata.create');
// Process loan data and create the necessary tables
Route::get('emi-details', [LoanController::class, 'getEMiDetails'])->name('emidetails');
Route::get('/dashbaord', [LoanController::class, 'dashboard'])->name('welcome');


