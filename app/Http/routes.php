<?php
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('helo', 'HeloController@helo');

Route::get('/nxtnifty', 'NxtNiftController@index');


Route::get('names', function()
{
    return array(
        1 => "John",
        2 => "Mary",
        3 => "Steven"
    );
});


Route::Resource('names','NamesController');
