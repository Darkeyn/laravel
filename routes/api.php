<?php

use App\Http\Controllers\Api\AccessController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ProjectUserController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:sanctum')->get('/auth', function () {
//     return true;
// });

Route::post('register', [RegisterController::class,'register']);

Route::apiResources([
    'users' => UserController::class,
    'projects' => ProjectController::class,
    'projectsinfo' => ProjectUserController::class,
]);


Route::group([

    'middleware' => 'api'

], function ($router) {
    
    Route::post('access/{project_id}/{user_id}', [AccessController::class,'info']);
    Route::post('login', [LoginController::class,'login']);
    Route::post('logout', [LoginController::class,'logout']);
    //Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('user', [LoginController::class,'user']);
    Route::post('checkToken', [LoginController::class,'checkToken']);
    //Route::post('admin', [AdminController::class,'index']);

});