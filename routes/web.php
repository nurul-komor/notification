<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Notifications\FollowNotification;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    /* ---------------------------- send Notification --------------------------- */
    Route::get('/followedBy/{id}', function ($id) {
        if (auth()->user()->id != $id) {
            $user = User::find($id);
            auth()->user()->notify(new FollowNotification($user));
        }
        return redirect()->back();
    })->name('markRead');
    /* ------------------------------ mark as read ------------------------------ */
    Route::get('markRead/{id}', function ($id) {
        if ($id != null) {
            auth()->user()->notifications->find($id)->markAsRead();
        }
        return redirect()->back();
    })->name('markRead');
    /* ------------------------------ mark as read ------------------------------ */
    Route::get('markUnRead/{id}', function ($id) {
        if ($id != null) {
            $notification = auth()->user()->notifications->find($id);
            $notification->update(['read_at' => null]);
        }
        return redirect()->back();
    })->name('markUnRead');

    /* ---------------------------- mark all as read ---------------------------- */
    Route::get('readAll', function () {

        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back();
    })->name('readAll');
});

require __DIR__ . '/auth.php';
