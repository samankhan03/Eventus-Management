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
use App\Http\Controllers\EventController; // Corrected path
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

Route::middleware(['auth:sanctum', 'verified'])->prefix('user')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('profile/{user:username}', [ProfileController::class, 'show'])->name('profiles.show');

    Route::get('members', [MemberController::class, 'index'])->name('members.index');
    Route::get('search', [MemberController::class, 'search'])->name('search');

    // Posts
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::post('', [PostController::class, 'store'])->name('store');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
    });

    // Comments
    Route::prefix('comments')->name('comments.')->group(function () {
        Route::post('/{post}/comments', [CommentController::class, 'store'])->name('store');
    });

    // Friends
    Route::prefix('friends')->name('friends.')->group(function () {
        Route::get('', [FriendController::class, 'index'])->name('index');
        Route::post('/{user}', [FriendController::class, 'store'])->name('store');
        Route::patch('/{user}', [FriendController::class, 'update'])->name('update');
        Route::get('/{user}/deny', [FriendController::class, 'deny'])->name('deny'); // Changed route path for consistency
        Route::delete('/{user}', [FriendController::class, 'destroy'])->name('destroy');
    });

    // Post Likes
    Route::prefix('post-likes')->name('post-likes.')->group(function () { // Corrected prefix name
        Route::post('/{post}', [PostLikeController::class, 'store'])->name('store');
        Route::delete('/{post}', [PostLikeController::class, 'destroy'])->name('destroy');
    });

    // Comment Likes
    Route::prefix('comment-likes')->name('comment-likes.')->group(function () { // Corrected prefix name
        Route::post('/{comment}', [CommentLikeController::class, 'store'])->name('store');
        Route::delete('/{comment}', [CommentLikeController::class, 'destroy'])->name('destroy');
    });

    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::post('/mark-one/{id}', [NotificationController::class, 'markOne'])->name('markOne'); // Changed method name for clarity
        Route::get('/mark-all', [NotificationController::class, 'markAll'])->name('markAll');     // Changed method name for clarity
        Route::get('/delete/{id}', [NotificationController::class, 'destroy'])->name('destroy'); // Changed route path for consistency
    });

    // Chat Rooms
    Route::prefix('chat/rooms')->name('chat-rooms.')->group(function () {
        Route::get('', [RoomController::class, 'index'])->name('index');
        Route::get('create', [RoomController::class, 'create'])->name('create');
        Route::get('/{room:slug}', [RoomController::class, 'show'])->name('show');
        Route::post('/{room:slug}', [RoomController::class, 'update'])->name('update');
        Route::post('/{room:slug}/messages', [RoomController::class, 'store'])->name('store');
        Route::post('/{room:slug}/logout', [RoomController::class, 'logout'])->name('logout'); 
        
    });
    Route::post('chat/rooms', [RoomController::class, 'store'])->name('chat-rooms.store');  // added route for new room

    // Events - Using Resource Route AND adding extra routes.
    Route::resource('events', EventController::class); // ->names('events'); //You can add this if you want to override names

    Route::post('events/{event}/attendees', [EventController::class, 'eventAttendees'])->name('events.attendees'); // added {event}
    Route::get('events/tickets', [EventController::class, 'tickets'])->name('events.tickets');

     // Event Likes
    Route::prefix('event-likes')->name('event-likes.')->group(function () {  // corrected prefix
        Route::post('/{event}', [EventLikeController::class, 'store'])->name('store');
        Route::delete('/{event}', [EventLikeController::class, 'destroy'])->name('destroy');
    });

    // Event Comments
    Route::prefix('event-comments')->name('event-comments.')->group(function () { // corrected prefix
        Route::post('/{event}/comments', [EventCommentController::class, 'store'])->name('store');
    });
});
