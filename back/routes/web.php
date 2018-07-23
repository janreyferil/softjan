<?php
use App\Model\User\Role;
use App\Model\Education\Subject;
use App\Model\User\User;
use App\Model\User\UserDetail;
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
    return response()->json([
        'role' => Role::all(),
        'subject' => Subject::all(),
        'user' => User::all(),
        'detail' => UserDetail::all()
    ],200);
    // return $router->app->version();
});

$router->post('/register','User\RegisterController@registerUser');
