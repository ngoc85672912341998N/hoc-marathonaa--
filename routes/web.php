<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\UserController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/usercontrol', [UserController::class, 'role_user']);
Route::get('/createduser', [UserController::class, 'createduserview']);
Route::controller(UserController::class)->group(function () {
    Route::post('/createdroleuser', 'addRole'); 
    Route::delete('/removeroleuser', 'deleteRole'); 
    Route::put('/updateroleuser', 'UpdateRole'); 
    Route::get('/selectuser', 'select_roles'); 
    Route::post('/insertuser', 'insert_users'); 
    Route::put('/updateuser', 'Updateusers');
    Route::delete('/deleteuser', 'deleteuser');
});