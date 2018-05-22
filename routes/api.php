<?php

use Illuminate\Http\Request;

Route::get('location/states/{country_id}', 'Api\LocationController@states');
Route::get('location/cities/{state_id}', 'Api\LocationController@cities');
