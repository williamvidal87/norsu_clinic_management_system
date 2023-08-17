<?php

use App\Http\Livewire\AdminPanel\ManageRequestCheckup\ManageRequestCheckupTable;
use App\Http\Livewire\AdminPanel\MedecineInventory\MedecineInventoryTable;
use App\Http\Livewire\AdminPanel\WalkIn\WalkInTable;
use App\Http\Livewire\Dashboard\DashBoard;
use App\Http\Livewire\PatientPanel\RequestCheckup\RequestCheckupTable;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/dashboard', DashBoard::class)->name('dashboard');
    Route::get('/request-checkup-table', RequestCheckupTable::class)->name('request-checkup-table')->middleware('PatientMiddleware');
    Route::get('/manage-checkup-request-table', ManageRequestCheckupTable::class)->name('manage-checkup-request-table')->middleware('AdminMiddleware');
    Route::get('/medicine-inventory-table', MedecineInventoryTable::class)->name('medicine-inventory-table')->middleware('AdminMiddleware');
    Route::get('/walk-in-table', WalkInTable::class)->name('walk-in-table')->middleware('AdminMiddleware');
});
