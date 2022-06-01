<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\ArtistCategoryController;
use App\Http\Controllers\Api\AuthController;

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

Route::post('/login', [AuthController::class, 'login'])->name('spa.login');
Route::post('/register', [AuthController::class, 'register'])->name('spa.register');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth'])->group(function () {
    Route::resource('artists', ArtistController::class);
    Route::resource('artist-category', ArtistCategoryController::class);
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::resource('artists', ArtistController::class);
});


























// use Laravel\Fortify\Features;
// use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
// use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
// use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
// use Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController;
// use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
// use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
// use Laravel\Fortify\Http\Controllers\NewPasswordController;
// use Laravel\Fortify\Http\Controllers\PasswordController;
// use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
// use Laravel\Fortify\Http\Controllers\ProfileInformationController;
// use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
// use Laravel\Fortify\Http\Controllers\RegisteredUserController;
// use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
// use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
// use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
// use Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController;
// use Laravel\Fortify\Http\Controllers\VerifyEmailController;

/*
FORTIFY ROUTES

*/
// $limiter = config('fortify.limiters.login');
// $twoFactorLimiter = config('fortify.limiters.two-factor');
// $verificationLimiter = config('fortify.limiters.verification', '6,1');

// // Authentication...
// Route::post('/login', [AuthenticatedSessionController::class, 'store'])
//     ->middleware(array_filter([
//         'guest:'.config('fortify.guard'),
//         $limiter ? 'throttle:'.$limiter : null,
//     ]));

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->name('logout');

// Route::post('/register', [RegisteredUserController::class, 'store'])
//     ->middleware(['guest:'.config('fortify.guard')]);

// Route::post('/logout', [AuthController::class, 'logout'])->name('spa.logout');



