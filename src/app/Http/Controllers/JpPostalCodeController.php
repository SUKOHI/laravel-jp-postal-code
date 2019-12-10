<?php

namespace Sukohi\LaravelJpPostalCode\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sukohi\LaravelJpPostalCode\App\JpPostalCode;

class JpPostalCodeController extends Controller
{
    public function index(Request $request) {

        $postal_code = null;
        $first_code = '';
        $last_code = '';

        if($request->filled('first_code', 'last_code')) {

            $first_code = mb_convert_kana($request->first_code, 'a');
            $last_code = mb_convert_kana($request->last_code, 'a');

        } else if($request->filled('code')) {

            $code = preg_replace('|[^0-9]*|', '',
                mb_convert_kana($request->code, 'a')
            );
            $first_code = substr($code, 0, 3);
            $last_code = substr($code, 3, 4);

        }

        if(preg_match('|[0-9]{3}|', $first_code) && preg_match('|[0-9]{4}|', $last_code)) {

            $postal_code = JpPostalCode::whereSearch($first_code, $last_code)->first();

        }

        return ['postal_code' => $postal_code];

    }
}
