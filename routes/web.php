<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AssignmentController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChatRoomController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\FullCalendarController;


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
//calendar events controller 

Route::get('full-calendar', [FullCalendarController::class, 'index']);
Route::post('full-calendar/action', [FullCalendarController::class, 'action']);
Route::get('full-calendar/events',[FullCalendarController::class,'getEvents']);


Route::get('/all_users',[FullCalendarController::class,'users']);

//notifications
Route::post('/mark-notification-as-read/{notification}', [NotificationController::class, 'markAsRead'])->name('mark_notification_as_read');
Route::get('/unread-notifications', [NotificationController::class, 'unreadNotifications'])->name('unread_notifications');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('/get-notification-count', [NotificationController::class, 'getNotificationCount'])->name('get_notification_count');




Route::middleware('admin')->group(function () {
    Route::get('/admin/login',[AdminLoginController::class,'index'])->name('adminLogin');
	Route::post('/admin/store',[AdminLoginController::class,'store'])->name('admin.store');
	Route::get('/admin/dashboard',[AdminDashboardController::class,'index'])->name('adminDashboard');
	Route::get('admin-profile', function () {
		return view('pages.laravel-examples.admin-profile');
	})->name('admin-profile');
   Route::post('admin-profile',[AdminProfileController::class,'update']);
   Route::get('/create-assignment',[AssignmentController::class,'create'])->name('create_assignment');
   Route::post('/assignments',[AssignmentController::class,'store'])->name('store_assignment');

   Route::get('/admin/assignments',[AssignmentController::class,'adminIndex'])->name('admin_assignments');
   Route::get('admin_assignments/{id}/edit',[AssignmentController::class,'edit'])->name('assignEdit');
   Route::put('admin_assignments/{id}/assignUpdate',[AssignmentController::class,'assignUpdate'])->name('assignUpdate');
   Route::delete('admin_assignments/{id}/delete-attachment', [AssignmentController::class, 'deleteAttachment'])->name('deleteAttachment');
   Route::get('assigned_assignments',[AssignmentController::class,'assignedAssignments'])->name('assignedAssignments');
   Route::get('unassigned_assignments',[AssignmentController::class,'unassigned'])->name('unassignedAssignments');
   Route::get('users',[AdminDashboardController::class,'users'])->name('allMembers');
   Route::get('addMember',[AdminDashboardController::class,'create'])->name('addMember');
   Route::post('addMember/store',[AdminDashboardController::class,'store'])->name('store_member');
//    Route::get('sign-up', [RegisterController::class, 'create'])->name('register');
//    Route::post('sign-up', [RegisterController::class, 'store']);
   Route::get('users/{user}', [AdminDashboardController::class, 'show'])->name('user_show');

   //profile picture
//    Route::get('admin/profilepicture',ProfileController::class,'adminIndex')->name('adminIndex');
//    Route::post('admin/profilepicture',ProfileController::class,'adminStore')->name('adminStore');

  
  
   


});




// User routes
Route::middleware('auth')->group(function () {
    Route::get('/chat-room/{roomId}', [ChatRoomController::class, 'userChatRoom'])->name('user.chatRoom');
    Route::post('/chat/room/{roomId}/message', [ChatRoomController::class, 'sendMessage'])->name('chat.sendMessage');

});

// Admin routes
Route::middleware('auth:admin')->group(function () {
    Route::get('admin/chat-room/{roomId}', [ChatRoomController::class, 'showChatRoom'])->name('chat.show');
    Route::post('admin/chat/room/{roomId}/message', [ChatRoomController::class, 'sendMessage'])->name('admin.chat.sendMessage');
});

// API route
Route::prefix('api')->group(function () {
    Route::get('/chat/room/{roomId}/messages', [ChatRoomController::class, 'getMessages']);
});


		   

Route::get('/', function () {return redirect('sign-in');});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//user calendar routes
Route::get('user-calendar', [DashboardController::class, 'getEvents']);
Route::post('user-calendar/store', [DashboardController::class, 'createEvent']);
Route::get('user-calendar/fetch',[DashboardController::class,'retrieveEvents']);

Route::get('/sign-in', [SessionsController::class, 'create'])->name('login');
Route::post('/sign-in', [SessionsController::class, 'store'])->name('store');
Route::post('verify', [SessionsController::class, 'show'])->name('show');
Route::post('reset-password', [SessionsController::class, 'update'])->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::get('/tables', [AssignmentController::class,'index'])->name('tables');
Route::patch('/assignments/{id}/status/{status}', [AssignmentController::class, 'update'])->name('update.status');
Route::get('/assignments/{id}',[AssignmentController::class,'show'])->name('assignment_show');
Route::get('/user_view_details/{id}',[AssignmentController::class,'Usershow'])->name('user_view_details');
Route::put('assignments/{id}/updateStatus', [AssignmentController::class, 'updateStatus'])->name('updateStatus');
Route::get('/assignProgress',[DashboardController::class,'assignProgress'])->name('assignInProgress');
Route::get('/assignCompleted',[DashboardController::class,'assignCompleted'])->name('assignCompleted');


Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
//user profile picture
// Route::get('/profilepicture',ProfileController::class,'Index')->name('Index');
// Route::post('/profilepicture',ProfileController::class,'Store')->name('Store');

Route::group(['middleware' => 'auth'], function () {
	


	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	
	Route::get('notifications', function () {
		return view('pages.notifications');
    })->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');

  
// Add more routes as needed


	
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
