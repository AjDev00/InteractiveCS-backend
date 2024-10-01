<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyCommentController;
use App\Http\Controllers\ReplyOfReplyController;
use App\Http\Controllers\ReplyResponsesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('comments', [CommentController::class, 'store']);

Route::get('get-comments', [CommentController::class, 'index']);

// Route::get('add-like/{id}', [CommentController::class, 'addLike']);

Route::post('add-reply', [ReplyCommentController::class, 'store']);

Route::get('get-reply', [ReplyCommentController::class, 'index']);

Route::delete('erase-comment/{id}', [CommentController::class, 'destroy']);

Route::put('edit-comment/{id}', [CommentController::class, 'update']);

Route::get('get-single-comment/{id}', [CommentController::class, 'show']);

Route::delete('erase-reply/{id}', [ReplyCommentController::class, 'destroy']);

Route::put('edit-reply/{id}', [ReplyCommentController::class, 'update']);

Route::get('get-single-reply/{id}', [ReplyCommentController::class, 'show']);

Route::post('reply-response', [ReplyResponsesController::class, 'store']);

Route::delete('erase-response/{id}', [ReplyResponsesController::class, 'destroy']);

Route::put('edit-response/{id}', [ReplyResponsesController::class, 'update']);

Route::get('get-single-response/{id}', [ReplyResponsesController::class, 'show']);