<?php

Route::get('/', 'WebController@index')->name('index');
Route::any('/contact', 'WebController@contact')->name('contact');
Route::any('/terms', 'WebController@terms')->name('terms');
Route::any('/policy', 'WebController@policy')->name('policy');
Route::get('/shelters', 'WebController@shelters')->name('shelters');
Route::any('/new-shelter', 'WebController@new_shelter')->name('new_shelter');
Route::get('/new-shelter-created', 'WebController@new_shelter_created')->name('new_shelter_created');
