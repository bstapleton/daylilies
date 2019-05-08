<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact-us');
});

Route::get('/order-form', function () {
    return view('order-form');
});

Route::get('/plants', 'PlantController@index');
    Route::get('/plants/new', 'PlantController@listNew');
    Route::get('/plants/category/{category}', 'PlantController@listCategory');
    Route::get('/plants/genome/{genome}', 'PlantController@listGenome');
    Route::get('/plants/foliage/{foliage}', 'PlantController@listFoliage');
    Route::get('/plants/season/{season}', 'PlantController@listSeason');
    Route::get('/plants/view/{name}', 'PlantController@view');

Route::get('/breeder/{breederSlug}', 'BreederController@listPlants');

Route::get('/upload', 'ImportController@upload'); // localhost:8000/
Route::post('/uploadFile', 'ImportController@uploadFile');
