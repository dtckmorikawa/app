<?php

use Illuminate\Support\Facades\Input;
use WebDevEtc\BlogEtc\Controllers\BlogEtcImageUploadController;


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
    return view('frame');
})->name('frame');

Auth::routes();

Route::get('/header', function(){
    return view('layouts.header');
})->name('header');

Route::get('/welcome', function(){
    return view('welcome');
})->name('welcome');

Route::get('/textdiff', 'DiffText@index')
->name('difftest');

Route::post('/textdiff/refresh', 'DiffText@refresh')
->name('diffrefresh');

Route::get('/blog/search', 'converter@search')
->name('topic.search');

Route::post('/print_post/{blogPostSlug}', 'converter@print')
->name('print_post');

Route::get('/book', 'Booklist@index')
->name('book.index');

Route::post('/booksearch', 'Booklist@search')
->name('book.search');

Route::get('/booksearch', 'Booklist@search')
->name('book.search');

Route::get('/view/{bookSlug}', 'Booklist@bookview')
->name('book.view');

Route::post('/print_book/{bookSlug}', 'Booklist@printbook')
->name('book.print_book');

/* Draw Hierarchy for Books*/
Route::get('book-hierarchy-view','BookHierarchyController@manageHierarchy')
->name('book-hierarchy-view');

Route::post('add-book','BookHierarchyController@addHierarchy')
->name('add.book.hierarchy');

Route::get('topic-hierarchy-view','TopicHierarchyController@manageHierarchy')
->name('topic-hierarchy-view');

Route::post('add-topic','TopicHierarchyController@addHierarchy')
->name('add.Topic.hierarchy');

Route::post('upload_image','CkeditorController@image_or_video')
->name('upload');

Route::post('upload_image_dd','CkeditorController@image_or_video_dd')
->name('uploadwithdd');

/* added for admin-books */
Route::group(['prefix' => 'book-admin'], function () {

    //ブック一覧（管理画面）
    Route::get('/', 'AdminBook@index')
    ->name('adminbook.index');

    //ブック新規追加
    Route::get('/create', 'AdminBook@create')
    ->name('adminbook.create');

    //ブック新規追加(流用)
    Route::post('/createwbase/{bookSlug}', 'AdminBook@createwbase')
    ->name('adminbook.create_with_base');

    //ブック保存
    Route::post('/store', 'AdminBook@store')
    ->name('adminbook.store');
    
    //ブック編集
    Route::post('/edit/{bookSlug}', 'AdminBook@edit')
    ->name('adminbook.edit');

    //ブック編集(ページネーション)
    Route::get('/edit/{bookSlug}', 'AdminBook@edit')
    ->name('adminbook.edit');

    //ブック更新
    Route::patch('/update/{bookSlug}', 'AdminBook@update')
    ->name('adminbook.update');

    //ブックロック
    Route::post('/booklock/{bookSlug}', 'AdminBook@booklock')
    ->name('adminbook.booklock');

    //ブックアンロック
    Route::post('/bookunlock/{bookSlug}', 'AdminBook@bookunlock')
    ->name('adminbook.bookunlock');

    //ブック削除
    Route::delete('/delete/{bookSlug}', 'AdminBook@delete')
    ->name('adminbook.delete');

    //新ブック検索（admin画面）
    Route::post('/searchnew', 'AdminBook@searchnew')
    ->name('adminbook.searchnew');

    //新ブック検索（admin画面）
    Route::get('/searchnew', 'AdminBook@searchnew')
    ->name('adminbook.searchnew');

    //動画関係
    Route::group(['prefix' => "video_uploads",], function () {

        Route::get("/", "VideoUploadController@index")->name("admin.videos.all");

        Route::get("/upload", "VideoUploadController@create")->name("admin.videos.upload");
        Route::post("/upload", "VideoUploadController@store")->name("admin.videos.store");

        Route::get("/browsevideo", "VideoUploadController@browse")->name("browsevideo");
        Route::get('/videosearch', 'VideoUploadController@search')->name('admin.video.search');
        Route::get('/videosearch_in_browser', 'VideoUploadController@searchinbrowser')->name('admin.video.search.in.browser');
    });

});

Route::group(['prefix' => 'role-admin'], function () {
    //ユーザーの一覧（管理画面）
    Route::get('/', 'AdminRole@index')->name('adminrole.index');

    //ユーザー権限の編集
    Route::get('/edit/{id}', 'AdminRole@edit')->name('adminrole.edit');

    //ユーザー権限の更新
    Route::patch('/edit/{id}', 'AdminRole@update')->name('adminrole.update');

    //ユーザー検索（admin画面）
    Route::get('/search', 'AdminRole@search')->name('adminrole.search');
});