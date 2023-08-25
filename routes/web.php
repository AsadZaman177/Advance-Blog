<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Frond End Routes
Route::get('/','FrontEndController@index');
Route::get('/blog/{url}','FrontEndController@singleBlog');

Route::get('/about', function () {
    return view('frontend.about');
});

Route::get('/posts', function () {
    return view('frontend.sample');
});

Route::get('/contact', function () {
    return view('frontend.contact');
});



// Backend Routes
Route::group(['middleware' => 'auth'], function(){

        // User Panel Routes
        Route::get('/user/dashboard', 'BackendController@userDashboard');
        Route::get('/user/createblog', 'BackendController@createBlog');
        Route::post('/user/store', 'BlogController@store');
        Route::get('/user/editblog/{id}', 'BlogController@useredit');
        Route::post('/user/updateblog', 'BlogController@userupdate');
        Route::get('/user/awaitingblogs', 'BlogController@UserAwaitingBlogs');
        Route::post('/user/allawaitingblogs', 'BlogController@AllUserAwaitingBlogs');
        Route::get('/user/deleteBlog/{id}', 'BlogController@delete');
        Route::get('/user/approvedblogs', 'BlogController@UserApprovedBlogs');
        Route::post('/user/allapprovedblogs', 'BlogController@AllUserApprovedBlogs');


    Route::group(['middleware' => 'checkrole'], function(){
        Route::get('/dashboard', 'BackendController@Dashboard');
        Route::get('/cms', 'BackendController@cms');
        // Category Routes
        Route::get('/categories', 'CategoryController@index');
        Route::post('/addCategory', 'CategoryController@create');
        Route::post('/getAllCategories', 'CategoryController@show');
        Route::get('/getCategory/{id}', 'CategoryController@edit');
        Route::post('/updateCategory', 'CategoryController@update');
        Route::get('/deleteCategory/{id}', 'CategoryController@delete');

        // Category Routes
        Route::get('/tags', 'TagController@index');
        Route::post('/addTag', 'TagController@create');
        Route::post('/getAllTags', 'TagController@show');
        Route::get('/getTag/{id}', 'TagController@edit');
        Route::post('/updateTag', 'TagController@update');
        Route::get('/deleteTag/{id}', 'TagController@delete');

        // Blog Routes
        Route::get('/blogs', 'BlogController@index');
        Route::post('/getAllBlogs', 'BlogController@getAllBlogs');
        Route::get('/createblog', 'BlogController@create');
        Route::post('/storeblog', 'BlogController@store');
        Route::get('/editblog/{id}', 'BlogController@edit');
        Route::post('/updateblog', 'BlogController@update');
        Route::get('/deleteBlog/{id}', 'BlogController@delete');

        // Awaiting Approval blogs
        Route::get('/awaiting', 'BlogController@awaiting');
        Route::post('/getAllAwaiting', 'BlogController@getAllAwaiting');
        Route::get('/approveBlog/{id}', 'BlogController@approveBlog');

    });
});




