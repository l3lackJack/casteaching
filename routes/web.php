<?php

use App\Models\Video;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/videos/1', function () {
    $video = Video::find(1);
//    $video = new stdClass();
//    $video ->title = 'Ubuntu 101';
//    $video->description = 'Here description';
//    $video->published_at = 'December 13';
    return view('videos.show',[
        'video'=>$video
    ]);
});
