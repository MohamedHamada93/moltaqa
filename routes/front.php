<?php

Route::group(['middleware' => ['web']], function() {

    # home
    Route::get('/','front\HomeController@Home');
});
