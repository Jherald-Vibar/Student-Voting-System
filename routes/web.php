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
use App\Http\Controllers\Student\StudentController;
use App\Http\Middleware\CheckAdminLogin;
use App\Http\Middleware\HigherPositionMiddleware;
use App\Models\Election;
use Illuminate\Support\Facades\Auth;

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
    if(Auth::guard('student')->check()) {
        return redirect()->route('student.home');
    } else if(Auth::check()) {
        return redirect()->route('admin-home');
    }
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

Route::group(['middleware' => ['auth:student', 'no.cache'], 'prefix' => 'students'], function() {
    Route::get('/student-home', function() {
        $elections = Election::all();
        return view('students.home', compact('elections'));
    })->name('student.home');

    Route::get('/election', [StudentController::class, 'studentElection'])->name('studentElection');
    Route::get('/election/{eid}', [StudentController::class, 'studentVoteIndex'])->name('student-vote-form');
    Route::post('/election/vote/{eid}', [StudentController::class, 'voteStore'])->name('votes-store');
    Route::get('elections/winner', [StudentController::class, 'electionsWinner'])->name('student-election-winner');

});

Route::group(['middleware' => ['auth', 'no.cache'], 'prefix' => 'admin'], function () {
    //Pages
    Route::get('/home', [AdminController::class, 'home'])->name('admin-home');
    Route::get('/student-list', [StudentAuthController::class, 'useGoogleClient'])->name('student_list');

    //Candidate
    Route::post('/election/{eid}/position/{pid}', [AdminController::class, 'candidatesStore'])->name('candidate-store');
    Route::put('election/update-candidate/{id}', [AdminController::class, 'candidateEdit'])->name('candidate-update');
    Route::delete('/election/position-delete/{id}', [AdminController::class, 'candidateDelete'])->name('candidate-delete');

    //Results
    Route::get('/election/result', [AdminController::class, 'resultView'])->name('admin-result');
    Route::get('election/results/{id}', [AdminController::class, 'resultAll'])->name('admin-result-all');

    //Position
    Route::post('/election/{id}/position', [AdminController::class, 'positionStore'])->name('position-store');
    Route::get('/election/{eid}/position/{pid}', [AdminController::class, 'candidatesIndex'])->name('position-view');
    Route::delete('/election/delete/{id}', [AdminController::class, 'positionDelete'])->name('position-delete');

    //Election
    Route::get('/admin-election', [AdminController::class, 'index'])->name('election-index');
    Route::post('/admin-election', [AdminController::class, 'electionStore'])->name('election-store');
    Route::get('/election/position/{id}', [AdminController::class, 'electionView'])->name('election-position');
    Route::get('election/winner', [AdminController::class, 'electionWinner'])->name('election-winner');
    Route::get('/election/{id}/edit', [AdminController::class, 'editForm'])->name('election-edit');
    Route::put('election/{id}/update', [AdminController::class, 'update'])->name('election-update');
    Route::delete('/election/{id}', [AdminController::class, 'electionDelete'])->name('election-delete');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

