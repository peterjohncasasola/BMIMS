<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('purok', 'PurokController');
Route::get('searchPuroks', 'PurokController@searchPuroks');
Route::get('findPurok', 'PurokController@searchPuroks');
Route::get('getAllPuroks', 'PurokController@getAllPuroks');
Route::resource('residents', 'ResidentsController');
Route::get('residentVoterStatus', 'ResidentsController@voterStatus');
Route::get('getResidentsName', 'ResidentsController@getNames');
Route::get('countRecords', 'ResidentsController@count');
Route::get('getResidentId', 'ResidentsController@getId');

Route::resource('voters', 'VoterController');
Route::resource('households', 'HouseHoldController');
Route::resource('blotters', 'BlotterController');
Route::resource('officials', 'OfficialController');
Route::get('getData', 'OfficialController@getData');
Route::get('getOfficerId', 'OfficialController@getId');
Route::get('getOfficers', 'OfficialController@getCurrentOfficials');
