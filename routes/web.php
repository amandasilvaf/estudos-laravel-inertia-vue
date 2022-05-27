<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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
    return inertia('auth.login.LoginPage');
})->name('auth.login');

Route::get('/dashboard', function () {
    return inertia('home.dashboard.DashboardPage');
})->name('home.dashboard');

Route::get('/user/profile', function () {
    return inertia('user.profile.ProfilePage');
})->name('user.profile');

Route::post('/sign-in', function (Request $request) {
    $request->validate([
        'user_name' => 'required|min:5',
        'password' => 'required|min:5',
    ]);
    return redirect()->route('home.dashboard');
})->name('auth.signIn');



Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');

Route::get('/nameGenerator', [UserController::class, 'nameGenerator'])->name('nameGenerator');


Route::get('/usersInJson', [UserController::class, 'jsonUsers']);
