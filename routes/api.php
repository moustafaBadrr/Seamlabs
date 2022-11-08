<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProblemSolvingController;
use App\Http\Controllers\UserController;
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

Route::post("/user/create", [UserController::class, "create"]);
Route::post("/user/login", [UserController::class, "login"]);

Route::middleware('auth:api')->group( function () {
    Route::get("numbers_without_five/{first_parameter}/{second_parameter}",[ProblemSolvingController::class, "numbersWithoutFive"]);
    Route::get("column_index/{string}",[ProblemSolvingController::class, "indexOfColumnTitle"]);
    Route::get("mini_steps/{numbers}",[ProblemSolvingController::class, "minimumStepsToZero"]);

    //User Operations
    Route::get("/user/read/{id}", [UserController::class, "read"]);
    Route::get("/user/read", [UserController::class, "read_all"]);
    Route::post("/user/update", [UserController::class, "update"]);
    Route::delete("/user/delete/{id}", [UserController::class, "delete"]);
    Route::post("/user/logout", [UserController::class, "logout"]);
});
