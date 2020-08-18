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
$router->group(['middleware' => 'auth','prefix' => 'api'], function ($router) 
{
    $router->get('login', 'AuthController@login');
});

$router->group(['prefix' => 'api'], function () use ($router) 
{
   $router->post('register', 'AuthController@register');
   $router->post('Authenticate', 'AuthController@Authenticate');
   //=========== TasksContoller Routes
   $router->get('getTasks', ['uses' => 'TasksController@getTasks']);
   $router->get('getTasksByDate', ['uses' => 'TasksController@getTasksByDate']);
   $router->get('getTasksByMonth', ['uses' => 'TasksController@getTasksByMonth']);
   $router->post('updateTask/{id}', ['uses' => 'TasksController@updateTask']);
   $router->post('addTask', ['uses' => 'TasksController@addTask']);

   //=================== StatusesController Routes ========
   $router->get('getAllStatus', ['uses' => 'StatusesController@getAllStatus']);
   $router->post('addStatus', ['uses' => 'StatusesController@addStatus']);
   $router->post('updateStatus/{id}', ['uses' => 'StatusesController@updateStatus']);
   $router->post('deleteStatus/{id}', ['uses' => 'StatusesController@deleteStatus']);
   //================= CategoriesController Routes ============
   $router->get('getAllCategories', ['uses' => 'CategoriesController@getAllCategories']);
   $router->post('addCategory', ['uses' => 'CategoriesController@addCategory']);
   $router->post('updateCategory/{id}', ['uses' => 'CategoriesController@updateCategory']);
   $router->post('deleteCategory/{id}', ['uses' => 'CategoriesController@deleteCategory']);
});

