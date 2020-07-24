<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


// $router->group(['middleware' => 'auth'], function () use ($router) {
$router->group(['prefix' => 'rest/payment'], function () use ($router) {

    //Customer
    $router->get('/customer', 'CustomerController@index');
    $router->post('/customer', 'CustomerController@create');
    $router->get('/customer/{id}', 'CustomerController@show');
    $router->patch('/customer/{id}', 'CustomerController@update');
    $router->delete('/customer/{id}', 'CustomerController@destroy');


    //Order
    $router->get('/order', 'OrderController@index');
    $router->post('/order', 'OrderController@create');
    $router->get('/order/{id}', 'OrderController@show');
    $router->patch('/order/{id}', 'OrderController@update');
    $router->delete('/order/{id}', 'OrderController@destroy');


    //Product
    $router->get('/product', 'ProductController@index');
    $router->post('/product', 'ProductController@create');
    $router->get('/product/{id}', 'ProductController@show');
    $router->patch('/product/{id}', 'ProductController@update');
    $router->delete('/product/{id}', 'ProductController@destroy');


    //Post
    $router->get('/orderitem', 'OrderItemController@index');
    $router->post('/orderitem', 'OrderItemController@create');
    $router->get('/orderitem/{id}', 'OrderItemController@show');
    $router->patch('/orderitem/{id}', 'OrderItemController@update');
    $router->delete('/orderitem/{id}', 'OrderItemController@destroy');


    //Comment
    $router->get('/payments', 'PaymentController@index');
    $router->post('/payments', 'PaymentController@create');
    $router->get('/payments/{id}', 'PaymentController@show');
    $router->patch('/payments/{id}', 'PaymentController@update');
    $router->delete('/payments/{id}', 'PaymentController@destroy');
});
// });
