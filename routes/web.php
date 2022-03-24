<?php
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ReservationController as ReservationFrontOffice;
use App\Http\Controllers\MainController;
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

// ajouter la route '/' associée avec l'action MainController::index()
// MainController est une classe et index est une méthode de cette classe
// cette route est nommée 'main.index'
Route::get('/', [MainController::class, 'index'])->name('main.index');
Route::get('/test', [MainController::class, 'test'])->name('main.test');
Route::get('/test-resa', [MainController::class, 'testReservation'])->name('main.testReservation');
Route::get('/reservation', [MainController::class, 'reservation'])->name('main.reservation');
Route::get('/contact', [MainController::class, 'contact'])->name('main.contact');
Route::get('/carte', [MainController::class, 'carte'])->name('main.carte');

Route::post('/reservation', [MainController::class, 'store'])->name('main.reservation.post');



// back office
// affichage de la liste des reservations
Route::get('/admin/reservation', [ReservationController::class, 'index'])->name('admin.reservation.index');

//back office page création des reservations par exemple
Route::get('/admin/reservation/create', [ReservationController::class, 'create'])->name('admin.reservation.create');
Route::post('/admin/reservation', [ReservationController::class, 'store'])->name('admin.reservation.store');

//back office page modification des reservations par exemple
Route::get('/admin/reservation/{id}/edit', [ReservationController::class, 'edit'])->name('admin.reservation.edit');
Route::put('/admin/reservation/{id}', [ReservationController::class, 'update'])->name('admin.reservation.update');

Route::delete('/admin/reservation/{id}', [ReservationController::class, 'destroy'])->name('admin.reservation.destroy');


