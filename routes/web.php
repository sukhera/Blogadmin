<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', [
    'uses' => 'PostController@getIndex',
    'as'   => 'blog.index'
]);

Route::get('post/{id}', [
    'uses' => 'PostController@getPost',
    'as'   => 'blog.post'
]);

Route::get('post/{id}/likes', [
    'uses' => 'PostController@getLikesPost',
    'as'   => 'blog.post.like'
]);


Route::get('about', function () {
    return view('other.about');
})->name('other.about');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('', [
        'uses' => 'PostController@getAdminIndex',
        'as'   => 'admin.index'
    ]);

    Route::get('create', [
        'uses' => 'PostController@getAdminCreate',
        'as'   => 'admin.create'
    ]);

    Route::get('delete/{id}',[
        'uses' => 'PostController@getAdminDelete',
        'as'   => 'admin.delete'
     ]);

    Route::post('create', [
        'uses' => 'PostController@postAdminCreate',
        'as'   => 'admin.create'
    ]);;

    Route::get('edit/{id}', [
        'uses' => 'PostController@getAdminEdit',
        'as'   => 'admin.edit'
    ]);

    Route::post('edit', [
        'uses' => 'PostController@postAdminUpdate',
        'as'   => 'admin.update'
    ]);
});
Auth::routes();

Route::post('login',[
   'uses' => 'SigninController@signin',
    'as' => 'login',

]);
