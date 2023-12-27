<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CompanyController;
use App\Models\AppRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Token;

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

Route::get('/401', function () {
    return response()->json([
        'success' => false,
        'data' => null,
        'message' => 'token invalid or token expired',
        'code' => 401
    ], 401);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AccountController::class, 'loginHandler']);
Route::post('/register', [AccountController::class, 'newUserCompanyHandler']);
Route::get('/*', function() {
    return response()->json([
        'success' => false,
        'message' => 'ROUTE NOT FOUND',
        'code' => 404,
        'data' => null
    ]);
});

Route::middleware('auth:api')->group(function () {
    Route::get("/user", [AccountController::class, 'userInfoHandler']);
    Route::post('/logout', [AccountController::class, 'logoutHandler']);

    Route::get('/roles', [AccountController::class, 'lookupRolesHandler']);
    Route::post('/permission/add-remove', [AccountController::class, 'addRemovePermissionHandler']);

    Route::get('/company/list', [CompanyController::class, 'companyListHandler']);
});
