<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/auth')
        ->namespace('Api\V1')
        ->group(function () {
            Route::post('login', 'AuthController@login');
            Route::get('refresh', 'AuthController@refresh');
            Route::group(['middleware' => 'auth:api'], function() {
                Route::get('user', 'AuthController@user');
                Route::put('user/{id}', 'AuthController@update');
                Route::post('logout', 'AuthController@logout');
            });
        });


Route::prefix('v1')
        ->middleware('auth')
        ->namespace('Api\V1')
        ->group(function () {
            
            Route::get('clientes/autocomplete', 'Cadastro\ClientesController@autocomplete');
            Route::get('tipodemandas/autocomplete', 'Cadastro\TipoDemandasController@autocomplete');
            Route::get('tipostatus/autocomplete', 'Cadastro\TipoStatusController@autocomplete');
            Route::get('usuarios/autocomplete', 'Cadastro\UsuariosController@autocomplete');
            
            Route::get('dashboard/estatisticas', 'DashboardController@estatisticas');
            
            Route::post('fichatriagens/impressao', 'Movimento\FichaTriagensController@impressao');
            
            Route::apiResources([
                'usuarios' => 'Cadastro\UsuariosController',
                'tipodemandas' => 'Cadastro\TipoDemandasController',
                'tipostatus' => 'Cadastro\TipoStatusController',
                'clientes' => 'Cadastro\ClientesController',
                'fichatriagens' => 'Movimento\FichaTriagensController'
            ]);
            Route::get('parametrostriagem', 'Cadastro\ParametrosTriagemController@show');
            Route::post('parametrostriagem', 'Cadastro\ParametrosTriagemController@store');
            Route::delete('telefones/{id}', 'Cadastro\TelefonesController@destroy');
            Route::get('nacionalidades', 'Cadastro\NacionalidadesController@index');
        });
