<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocPrinterController;
use App\Models\User;
use App\Models\Reciept;
use App\Models\event_rating;
use App\Models\event_picture; 
use App\Models\comment; 
use App\Models\advert;
use App\Models\like; 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use amirsanni\phpewswrapper\PhpEwsWrapper;
use App\Models\ticketRequest;
use App\Models\MemoApproval;
use App\Models\event;
use App\Models\visitor;


use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController; 

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


//Clear App cache:
Route::get('/larafresh', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('route:cache');
    Artisan::call('clear-compiled');
    Artisan::call('config:clear');
    Artisan::call('config:cache');

    return 'Project Refreshed Successfully!!!';
});




//Clear route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');

    return 'Routes cache cleared';
});
//Clear config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');

    return 'Config cache cleared';
});
// Clear application cache:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');

    return 'Application cache cleared';
});
// Clear view cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');

    return 'View cache cleared';
});

Auth::routes();


Route::get('/logout', [LoginController::class, 'logout'])->name('logout-link');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/event_details/{event_id}/{Events_id}', [EventController::class, 'show'])->name('event_details');
Route::post('/events/{eventId}/rate', [EventController::class, 'rateEvent'])->name('submit.rating');
Route::get('/events/{eventId}/check-rating/{userId}', [EventController::class, 'checkRating']);
Route::post('/events/{eventId}', [EventController::class, 'rateEvent']);
Route::post('/event/picture/upload', [EventController::class, 'upload'])->name('event.picture.upload');
Route::get('/event/{event_id}/pictures', [EventController::class, 'showEventPictures'])->name('event.pictures');


Route::post('/like', [EventController::class, 'like']);


Route::post('/comments', [EventController::class, 'store']);
Route::get('/create_event', [EventController::class, 'create']);
Route::post('/storeevent', [EventController::class, 'storeevent'])->name('storeevent');
Route::get('/upcoming_events', [EventController::class, 'index'])->name('upcoming_events');
Route::get('/posts', [EventController::class, 'posts'])->name('posts');
Route::get('/edit/{event_id}', [EventController::class, 'editevent'])->name('edit');
Route::post('/update/{event_id}', [EventController::class, 'updateevent'])->name('updateevent');

// Route to show the confirmation page
Route::get('/confirm_delete/{event_id}', [EventController::class, 'confirmDelete'])->name('events.confirmDelete');
// Route to handle the delete action
Route::delete('/events/{event_id}', [EventController::class, 'deleteEvent'])->name('events.delete');
//profile picture update
Route::post('/profile/update-picture', [EventController::class, 'updateProfilePicture'])->name('profile.updatePicture');

//delete event picture
use App\Http\Controllers\EventPictureController;

// Other routes...

Route::delete('/event-pictures/{id}', [EventController::class, 'destroy'])->name('eventPictures.destroy');

Route::post('/mtn-callback', [EventController::class, 'handleMtnCallback']);

Route::post('/store-event-id', [EventController::class, 'storeEventId']);



Route::get('/clear-cache', function() {
    \Artisan::call('config:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    return "Cache cleared successfully!";
});





Route::get('/profile', [ProfileController::class, 'userProfile'])->name('profile');
Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile');
Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');

Route::post('/approve/{id}', [EventController::class, 'approve'])->name('approve');
Route::post('/reject/{id}', [EventController::class, 'reject'])->name('reject');



Route::post('/approve_Ads/{id}', [EventController::class, 'approve_Ads'])->name('approve_Ads');
Route::post('/reject_Ads/{id}', [EventController::class, 'reject_Ads'])->name('reject_Ads');

//add flyers
Route::get('/add_advert', [EventController::class, 'create_Advert']);
Route::post('/add_advert', [EventController::class, 'add_advert'])->name('add_advert');   


Route::get('/get_feature', [App\Http\Controllers\HomeController::class, 'get_feature']);

Route::get('/top_search', [App\Http\Controllers\HomeController::class, 'top_search']);
 

Route::post('/feature/{event_id}', [EventController::class, 'feature'])->name('feature');

Route::post('/unfeature/{event_id}', [EventController::class, 'unfeature'])->name('unfeature');