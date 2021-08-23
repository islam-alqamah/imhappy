<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\SurveyTemplateApi;

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

Route::get('survey/template/{template}/questions', [SurveyTemplateApi::class, 'getTemplateQuestions'])->name('template-questions');
Route::post('questions/{point}', [ApiController::class, 'questions'])->name('questions');
Route::post('answers/{point}', [ApiController::class, 'postAnswer'])->name('answer');
Route::post('user/logout', [ApiController::class, 'logout'])->name('api-logout');

