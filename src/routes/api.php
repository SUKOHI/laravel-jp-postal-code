<?php

Route::get(config('jp_postal_code.endpoint'), 'Sukohi\LaravelJpPostalCode\App\Http\Controllers\JpPostalCodeController@index');
