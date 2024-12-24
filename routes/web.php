<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function (Request $request) {
    return inertia('Home', [
        'users' => User::when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%');
        })->paginate(5)->withQueryString(),
        'searchTerm' => $request->search,
        'can' => [
            'delete_user' => Auth::user() ? Auth::user()->can('delete', User::class) : null,
        ]
    ]);
})->name('home');

Route::inertia('/about','About', [
    'user' => 'Vadim(local)'
])->name('about'); //краткая запись

Route::middleware('guest')->group(function () {


    Route::inertia('/register','Auth/Register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::inertia('/login','Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});



Route::middleware('auth')->group(function () {
    Route::inertia('/dashboard','Dashboard')->name('dashboard'); //краткая запись
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});






