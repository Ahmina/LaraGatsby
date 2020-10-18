<?php


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

Route::post('/newcrawl', 'CrawlUserController@newCrawl');
Route::get('/newtoken', 'AuthTokenController@createToken');

Route::get('post/{id}', 'CommentController@getCommentsByPodtId');

Route::post('/newmessage', 'MessageController@newMessage');


Route::post('getnewcommentsbypostid/{id}', 'CommentController@getNewAndUpdateComments');

Route::post('/newcomment', 'CommentController@newComment');
Route::post('/editcomment', 'CommentController@editComment');
Route::post('/deletecomment', 'CommentController@deleteComment');

Route::get('/historycomments', 'HistoryOfChangeController@getAllList');