<?php

use Illuminate\Routing\RouteGroup;
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

// Route::get('/', function () {
//     return view('dashboard');
// });



Auth::routes();


Route::group(['middleware' => 'guest'], function() {
    Route::get('/', function () {
        return view('auth.login');
    });//
});


Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth']
], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    // Route::get('/', function () {
    //     return view('dashboard');
    // });

    // Route::get('test', function () {
    //     return View::make('test');
    // });
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

  Route::group(['namespace' => 'Grades'], function() {
        Route::resource('Grades', 'GradeController');
//
  });

});


