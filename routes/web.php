<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;

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

Route::get("/", [TaskController::class, "showIndexView"])->name("tasks.showIndex");
Route::get("/categories/create", [CategoryController::class, "showCreateView"])->name("categories.showCreate");
Route::get("/categories/{id}/edit", [CategoryController::class, "showEditView"])->name("categories.showEdit");
Route::post("/categories/create", [CategoryController::class, "create"])->name("categories.create");
Route::post("/categories/{id}/update", [CategoryController::class, "update"])->name("categories.update");
Route::post("/categories/{id}/delete", [CategoryController::class, "delete"])->name("categories.delete");
Route::get("/categories/{id}/tasks/create", [TaskController::class, "showCreateView"])->name("tasks.showCreate");
Route::get("/tasks/{id}/edit", [TaskController::class, "showEditView"])->name("tasks.showEdit");
Route::post("/categories/{id}/tasks/create", [TaskController::class, "create"])->name("tasks.create");
Route::post("/tasks/{id}/update", [TaskController::class, "update"])->name("tasks.update");
Route::post("/tasks/{id}/delete", [TaskController::class, "delete"])->name("tasks.delete");
