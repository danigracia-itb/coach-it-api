<?php

use App\Http\Controllers\API\AthleteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Contollers
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BodyWeightController;
use App\Http\Controllers\API\CoachController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\ExerciseController;
use App\Http\Controllers\API\PasswordRecoverController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\RestDayController;
use App\Http\Controllers\API\StatsController;
use App\Http\Controllers\API\TracController;
use App\Http\Controllers\API\WorkoutController;
use App\Models\RestDay;

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

//public

//Contact Us
Route::post("contact-us", [ContactController::class, "submit"]);

// user
Route::post('/login',  [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware("jwtAuth");
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware("jwtAuth");
Route::get('/get-user', [AuthController::class, 'getUser'])->middleware("jwtAuth");

Route::post('users/request-password-recover', [PasswordRecoverController::class, 'requestPasswordRecover']);
Route::post('users/password-recover', [PasswordRecoverController::class, 'passwordRecover']);

//get specific user
Route::get('users/{id}', [AuthController::class, 'show']);

//update user data
Route::put("users/change-name/{id}", [AuthController::class, "changeName"]);
Route::post("users/change-picture/{id}", [AuthController::class, "changePicture"]);
Route::put("users/change-data/{id}", [AuthController::class, "changeData"]);
Route::put("users/change-coach/{id}", [AuthController::class, "changeCoach"]);

//athletes
Route::get('coach/get-athletes/{id}', [AthleteController::class, 'getAthletes']);
Route::get('coach/get-athlete-profile/{id}', [AthleteController::class, 'getAthleteProfile']);
Route::get('coach/get-athlete-calendar/{id}', [AthleteController::class, 'getAthleteCalendar']);

Route::post('athlete/user-data', [AthleteController::class, 'storeUserData']);
Route::delete('athlete/no-coach/{id}', [AthleteController::class, 'noCoach']);

//Exercises
Route::get('exercises/get-all-user/{id}', [ExerciseController::class, 'getAllUserExercises']);
Route::post('exercises', [ExerciseController::class, 'store']);
Route::delete('/exercises/{id}', [ExerciseController::class, 'destroy']);

//Workout
Route::post('workout', [WorkoutController::class, 'store']);
Route::get('workout/{id}', [WorkoutController::class, 'show']);
Route::put('workout/{id}', [WorkoutController::class, 'update']);
Route::delete('workout/{id}', [WorkoutController::class, 'destroy']);
Route::post('workout/copy/{id}', [WorkoutController::class, 'copy']);

//Stats
Route::get("stats/days-trained-last-month/{id}", [StatsController::class, "daysTrainedLastMonth"]);
Route::get("stats/days-trained-this-month/{id}", [StatsController::class, "daysTrainedThisMonth"]);
Route::get("stats/sets-done-this-month/{id}", [StatsController::class, "setsDoneThisMonth"]);

//Rest day
Route::post('rest-day', [RestDayController::class, 'restDay']);
Route::post('available-day', [RestDayController::class, 'availableDay']);

//payment
Route::post('payments', [PaymentController::class, 'store']);
Route::post("send-payment-reminder", [PaymentController::class, 'reminder']);

//BW
Route::post("/body-weights", [BodyWeightController::class, 'store']);
Route::put("/body-weights/{id}", [BodyWeightController::class, 'update']);
Route::get("/body-weights/{id}", [BodyWeightController::class, 'show']); //show user body weights

//Trac
Route::post("/trac", [TracController::class, 'store']);
Route::get("/trac/{id}", [TracController::class, 'show']);
Route::put("/trac/{id}", [TracController::class, 'update']);
Route::delete("/trac/{id}", [TracController::class, 'destroy']);
