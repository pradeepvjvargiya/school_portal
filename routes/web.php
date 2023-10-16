<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDocumentController;

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

Route::middleware(['auth.check'])->group(function () {
    // Add your protected routes here
    Route::get('student/list', function () {
        return view('student.list');
    });
});

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('student/list');
    } else {
        return redirect('student/login');
    }
});

// Login
Route::get('student/login', [LoginController::class, 'showLoginForm'])->name('students.login');
Route::post('student/login', [LoginController::class, 'login']);

// Logout
Route::post('student/logout', [LoginController::class, 'logout'])->name('logout');

// student CRUD
Route::middleware(['auth.check'])->prefix('student')->controller(StudentController::class)->group(function () {
    Route::get('/list', 'list')->name('student/list');
    Route::get('/create', 'create')->name('students.create');
    Route::post('/store','store')->name('student/store');
    Route::get('/edit/{id}', 'edit')->name('student/edit');
    Route::put('/update/{id}','update')->name('student/update');
    Route::get('/delete/{id}', 'destroy')->name('student/destroy');
});

// Student document
Route::middleware(['auth.check'])->prefix('student/{student_id}')->controller(StudentDocumentController::class)->group(function () {
    Route::get('/documents', 'index')->name('documents.index');
    Route::get('/documents/add', 'create')->name('documents.add');
    Route::post('/documents/store', 'store')->name('documents.store');
    Route::get('/document/{document_id}', 'edit')->name('documents.edit');
    Route::put('/document/{document_id}/update', 'update')->name('documents.update');
    Route::get('/document/delete/{document_id}', 'destroy')->name('documents.destroy');
    // Upload multiple document
    Route::get('/documents/addMultiple', 'addMultipleImages')->name('documents.addMultiple');
    Route::post('/documents/storeMultiple', 'storeMultipleImages')->name('documents.storeMultiple');
});
