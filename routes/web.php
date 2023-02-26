<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\AdminPizzaController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\UserPizzaController;
use App\Http\Controllers\CommandePizzaController;
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
    return view('main');
});

Route::view('/home','home')->middleware('auth');

Route::view('/admin','admin.home')->middleware('auth')->middleware('is_admin')
        ->name('admin.home');


Route::get('/login', [AuthenticatedSessionController::class,'showForm'])
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'login']);
Route::get('/logout', [AuthenticatedSessionController::class,'logout'])
    ->middleware('auth')->name('logout');


Route::get('/register', [RegisterUserController::class,'showForm'])
    ->name('register');
Route::post('/register', [RegisterUserController::class,'store']);

//Ajout d'une pizza dans table pizzas
Route::get('/admin_pizzas/create', [AdminPizzaController::class, 'create'])->middleware('is_admin')
    ->name('admin_pizzas.create');
Route::post('/admin_pizzas', [AdminPizzaController::class, 'store'])->middleware('is_admin')
    ->name('admin_pizzas.store');

//Affichage de la liste des pizzas  
Route::get('/admin_pizzas', [AdminPizzaController::class, 'index'])->middleware('is_admin')
    ->name('admin_pizzas.index');

//Changer le descriptif ou le nom d’une pizza
Route::get('/admin_pizzas/{id}/edit', [AdminPizzaController::class, 'edit'])->middleware('is_admin')
    ->name('admin_pizzas.edit');
Route::put('/admin_pizzas/{id}', [AdminPizzaController::class, 'update'])->middleware('is_admin')
    ->name('admin_pizzas.update');

//Changement de mot passe
Route::get('/admin_profile/edit', [AdminProfileController::class, 'edit'])->middleware('auth')
    ->name('admin_profile.edit');
Route::put('/admin_profile', [AdminProfileController::class, 'update'])->middleware('auth')
    ->name('admin_profile.update');

//Affichage de la liste des pizzas  
Route::get('/user_pizzas', [UserPizzaController::class, 'index'])->middleware('auth')
    ->name('user_pizzas.index');

//Ajout de pizza dans le panier et Passage de la commande 
Route::get('/user_pizzas/create', [UserPizzaController::class, 'create'])->middleware('auth')
->name('user_pizzas.create');
Route::post('/user_pizzas', [UserPizzaController::class, 'store'])->middleware('auth')
->name('user_pizzas.store');

// Modification de la quantité des pizzas dans le panier
Route::get('/user_pizzas/{id}/edit', [UserPizzaController::class, 'edit'])->name('user_pizzas.edit');
Route::put('/user_pizzas/{id}', [UserPizzaController::class, 'update'])->name('user_pizzas.update');

//Suppression des pizzas du panier
Route::get('/user_pizzas/{id}/delete', [UserPizzaController::class, 'delete'])->name('user_pizzas.delete');
Route::delete('/user_pizzas/{id}', [UserPizzaController::class, 'destroy'])->name('user_pizzas.destroy');

//Affichage du prix total de pannier
Route::get('/commandes_pizzas/{id}', [CommandePizzaController::class, 'show'])->name('commandes_pizzas.show');
