<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerroController;

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

Route::prefix('/perro')->group(function () use ($router){
    $router->get('/showPerros', [PerroController::class, 'showPerros']);
    $router->post('/createPerro', [PerroController::class, 'createPerro']);
    $router->post('/updatePerro', [PerroController::class, 'updatePerro']);
    $router->post('/deletePerro', [PerroController::class, 'deletePerro']);
    $router->post('/guardarInteresado', [PerroController::class, 'guardarInteresado']);
    $router->get('/verInteresados', [PerroController::class, 'verInteresados']);
});
