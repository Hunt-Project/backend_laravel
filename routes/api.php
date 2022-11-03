<?php
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
})->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

Route::post('/state', [AuthController::class, 'state']);

//Route::get()
// ['auth', 'verified']
// Protected + Verified Routes


Route::middleware('auth:sanctum')->group(function() {
    Route::post('/me', [AuthController::class, 'me']);
    Route::get('/sessions', [AuthController::class, 'sessions']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/email/resend', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');
});




// Gestione rotte applicazione
Route::get('/req', function (Request $request) {
    return $request;
})->middleware(['auth:sanctum', 'ability:moderator']);  // controlla permessi utente

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 