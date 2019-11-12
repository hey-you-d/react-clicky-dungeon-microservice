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

$router->get('/', 'Controller@_showWelcomeMessage');

$router->group(['prefix' => '/api/v1/', 'middleware' => 'allowcors'], function() use ($router) {
  $router->get('equipment', 'EquipmentController@_getResponse');
  $router->get('enemies', 'EnemiesController@_getResponse');
  $router->get('items', 'ItemsController@_getResponse');
  $router->get('doors', 'DoorsController@_getResponse');
  $router->get('areas', 'AreasController@_getResponse');
  $router->get('areaInfo', 'AreasController@_getCustomisedResponse');
});
