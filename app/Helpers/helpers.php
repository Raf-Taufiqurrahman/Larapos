<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('active')) {
    function active($params){
        return Route::is($params) ? 'active' : '' ;
    }
}

if(! function_exists('generate_barcode')){
    function generate_barcode($value, $threshold = null){
        return sprintf("%0". $threshold . "s", $value);
    }
}

if (! function_exists('moneyFormat')) {
    function moneyFormat($str) {
        return number_format($str, '0', '', '.');
    }
}
