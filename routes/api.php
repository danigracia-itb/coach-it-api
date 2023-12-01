<?php

use App\Http\Controllers\API\AthleteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Contollers
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CoachController;
use App\Http\Controllers\API\ExerciseController;
use App\Http\Controllers\API\PasswordRecoverController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// user
Route::post('/login',  [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware("jwtAuth");
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware("jwtAuth");
Route::get('/get-user', [AuthController::class, 'getUser'])->middleware("jwtAuth");

Route::post('users/request-password-recover', [PasswordRecoverController::class, 'requestPasswordRecover']);
Route::post('users/password-recover', [PasswordRecoverController::class, 'passwordRecover']);


//coach
Route::get('coach/get-athletes/{id}', [CoachController::class, 'getAthletes']);
Route::get('coach/get-athlete-profile/{id}', [CoachController::class, 'getAthleteProfile']);

//athlete
Route::post('athlete/user-data', [AthleteController::class, 'storeUserData']);

//Exercises
Route::get('exercises/get-all-user/{id}', [ExerciseController::class, 'getAllUserExercises']);
Route::post('exercises', [ExerciseController::class, 'store']);
Route::delete('/exercises/{id}', [ExerciseController::class, 'destroy']);
