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

Route::get('/plants', 'PlantController@index')->name('plants');
    Route::get('/plants/new', 'PlantController@listNew')->name('new');
    Route::get('/plants/category/{category}', 'PlantController@listCategory')->name('category');
    Route::get('/plants/foliage/{foliage}', 'PlantController@listFoliage')->name('foliage');
    Route::get('/plants/season/{season}', 'PlantController@listSeason')->name('season');
    Route::get('/plants/view/{slug}', 'PlantController@view')->name('view-plant');

Route::get('/breeder/{breederSlug}', 'BreederController@listPlants')->name('breeder');
