<?php

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/contact', function () {
    return view('contact-us');
})->name('contact-us');

Route::get('/order-form', function () {
    return view('order-form');
})->name('order-form');

Route::get('/search', 'SearchController@search')->name('search');

// TODO: refactor routes further - could be doable with a dispatcher of some sort and a single 'list' method maybe?
Route::group(['prefix' => 'plants', 'as' => 'plants.'], function() {
    Route::get('/', 'PlantController@index')->name('plants');
    Route::get('/category/{category}', 'PlantController@listCategory')->name('category');
    Route::get('/new', 'PlantController@listNew')->name('new');
    Route::get('/foliage/{foliage}', 'PlantController@listFoliage')->name('foliage');
    Route::get('/season/{season}', 'PlantController@listSeason')->name('season');
    Route::get('/view/{slug}', 'PlantController@view')->name('view');
});



Route::get('/breeder/{breederSlug}', 'BreederController@listPlants')->name('breeder');
