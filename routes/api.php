<?php

use App\Http\Controllers\todoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/user/register", [UserController::class, "register"]);
Route::post("/user/login", [UserController::class, "login"]);
Route::get("/todo/getAll/{user}", [UserController::class, "getTodos"])->middleware("auth:sanctum");
Route::post("/todo/add/{user}", [UserController::class, "add"])->middleware("auth:sanctum");
Route::put("/todo/done/{todo}", [todoController::class, "doneOrUndoneTodo"])->middleware("auth:sanctum");
