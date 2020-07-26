<?php

Route::get(
    config('zen.route'),
    "Meletisf\Zen\Http\Controllers\HealthController@index"
);
