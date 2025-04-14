<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\student\StudentAuthController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\PollController;
use App\Http\Middleware\CheckAdminLogin;
use App\Http\Middleware\HigherPositionMiddleware;
use App\Models\Election;

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
    $elections = Election::all();
    return view('home', compact('elections'));
})->name('home');




//Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::group(['prefix' => 'student'], function() {
    Route::get('/verify', [StudentAuthController::class, 'verify'])->name('verify');
    Route::post('/verify', [StudentAuthController::class, 'verification'])->name('verification');
    Route::get('/register', [StudentAuthController::class, 'register'])->name('register');
    Route::post('/register', [StudentAuthController::class, 'store'])->name('store');
});

Route::group(['middleware' => 'auth:student', 'prefix' => 'students'], function() {
    Route::get('/student-home', function() {
        $elections = Election::all();
        return view('students.home', compact('elections'));
    })->name('student.home');

});

Route::group(['middleware' => 'auth', 'prefix', 'admin'], function () {
    Route::get('/home', [AdminController::class, 'home'])->name('admin-home');
    Route::get('/admin-election', [AdminController::class, 'index'])->name('election-index');
    Route::post('/admin-election', [AdminController::class, 'electionStore'])->name('election-store');
    Route::get('/student-list', [StudentAuthController::class, 'useGoogleClient'])->name('student_list');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

