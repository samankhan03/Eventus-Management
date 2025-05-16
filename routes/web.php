<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\RoomController;
use App\Http\Controllers\User\FriendController;
use App\Http\Controllers\User\MemberController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\PostLikeController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\CommentLikeController;
use App\Http\Controllers\User\NotificationController;

use App\Http\Controllers\EventController;
use App\Http\Controllers\User\EventCommentController;
use App\Http\Controllers\User\EventLikeController;

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

Route::middleware(['guest'])->get('/', [WelcomeController::class, 'show'])->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->prefix('user')->group(function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('profile/{user:username}', [ProfileController::class, 'show'])->name('profiles.show');

    Route::get('members', [MemberController::class, 'index'])->name('members.index');

    // Searching member routes
    Route::get('/search', [MemberController::class, 'search'])->name('search');


    Route::prefix('posts')->name('posts.')->group(function() {
        Route::post('', [PostController::class, 'store'])->name('store');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('comments')->name('comments.')->group(function() {
        Route::post('/{post}/comments', [CommentController::class, 'store'])->name('store');
    });

    Route::prefix('friends')->name('friends.')->group(function() {
        Route::get('', [FriendController::class, 'index'])->name('index');
        Route::post('/{user}', [FriendController::class, 'store'])->name('store');
        Route::patch('/{user}', [FriendController::class, 'update'])->name('update');
        Route::get('/{user}', [FriendController::class, 'deny'])->name('deny');
        Route::delete('/{user}', [FriendController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('post-like')->name('post-like.')->group(function() {
        Route::post('/{post}', [PostLikeController::class, 'store'])->name('store');
        Route::delete('/{post}', [PostLikeController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('comment-like')->name('comment-like.')->group(function() {
        Route::post('/{comment}', [CommentLikeController::class, 'store'])->name('store');
        Route::delete('/{comment}', [CommentLikeController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('notifications')->name('notifications.')->group(function() {
        Route::post('/mark-one/{id}', [NotificationController::class, 'store'])->name('store');
        Route::get('/mark-all', [NotificationController::class, 'update'])->name('update');
        Route::get('/mark-delete/{id}', [NotificationController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('chat/rooms')->name('chat-rooms.')->group(function() {
        Route::get('', [RoomController::class, 'index'])->name('index');
        Route::get('create', [RoomController::class, 'create'])->name('create');
        Route::get('/{room:slug}', [RoomController::class, 'show'])->name('show');
        Route::post('/{room:slug}', [RoomController::class, 'update'])->name('update');
        Route::post('/{room:slug}/messages', [RoomController::class, 'store'])->name('store');
        Route::post('', [RoomController::class, 'roomLogout'])->name('roomLogout');
        
    });

    Route::post('new-room', [RoomController::class, 'newroom'])->name('new.room');

    Route::resource('events', EventController::class);

    Route::post('event-attendees', [EventController::class, 'eventAttendees'])->name('events.attendees');

    Route::get('events-tickets', [EventController::class, 'tickets'])->name('events.tickets');

    Route::prefix('event-like')->name('event-like.')->group(function() {
        Route::post('/{event}', [EventLikeController::class, 'store'])->name('store');
        Route::delete('/{event}', [EventLikeController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('eventcomments')->name('eventcomments.')->group(function() {
        Route::post('/{event}/comments', [EventCommentController::class, 'store'])->name('store');
    });

});
