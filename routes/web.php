<?php

use Illuminate\Support\Facades\Route;
use App\Notifications\EmailNotification;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/send-notification', function () {
//    $user = User::find(1);
//    $user->notify(new EmailNotification());
//});

//Route::get('/send-notification', function () {
//    $user = User::find(1);
//    Notification::send($user, new EmailNotification());
//});


Route::get('/send-notification', function () {
    $users = User::all();

    foreach ($users as $user){

        Notification::send($user, new EmailNotification());
    }
    return redirect()->back();

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
