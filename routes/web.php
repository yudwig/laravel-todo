<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/welcome', function() { return view('welcome'); });

Route::get('/', function() { return view('tasks.index'); })->name('tasks.showIndex');
Route::get('/categories/create', function() { return view('categories.create'); })->name('categories.showCreate');
Route::get('/categories/{id}/edit', function() { return view('categories.edit'); })->name('categories.showEdit');
Route::post('/categories/create', function() { echo "カテゴリー作成"; })->name('categories.create');
Route::post('/categories/{id}/update', function($id) { echo "カテゴリー更新 (id: {$id})"; })->name('categories.update');
Route::post('/categories/{id}/delete', function($id) { echo "カテゴリー削除 (id: {$id})"; })->name('categories.delete');
Route::get('/categories/{id}/tasks/create', function() { return view('tasks.create'); })->name('tasks.showCreate');
Route::get('/tasks/{id}/edit', function() { return view('tasks.edit'); })->name('tasks.showEdit');
Route::post('/categories/{id}/tasks/create', function() { echo "タスク作成"; })->name('tasks.create');
Route::post('/tasks/{id}/update', function($id) { echo "タスク更新 (id: {$id})"; })->name('tasks.update');
Route::post('/tasks/{id}/delete', function($id) { echo "タスク削除 (id: {$id})"; })->name('tasks.delete');
