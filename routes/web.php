<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

route::group(['middleware' => ['auth'],'namespace'  => 'Admin'],function(){
    //Usuário
    Route::get ('admin/reservistas', 'UsuarioController@getUsuariosReservistasAtivos')->name('reservistas.selecionar');
    Route::get ('admin/reservista/cadastrar', 'UsuarioController@create')->name('reservista.cadastrar');
    Route::post('admin/reservista/insert', 'UsuarioController@store')->name('reservista.insert');
    Route::get ('admin/reservista/editar/{idusuario}', 'UsuarioController@edit')->name('reservista.editar');
    Route::put ('admin/reservista/update', 'UsuarioController@update')->name('reservista.update');
    Route::put ('admin/reservista/excluir/{idusuario}', 'UsuarioController@destroy')->name('reservista.excluir');
    //NiveisEstudo
    Route::get ('admin/niveisEstudo', 'NivelEstudoController@index')->name('niveis.estudo.selecionar');
    Route::get ('admin/nivelEstudo/cadastrar', 'NivelEstudoController@create')->name('nivel.estudo.cadastrar');
    Route::post('admin/nivelEstudo/insert', 'NivelEstudoController@store')->name('nivel.estudo.insert');
    Route::get ('admin/nivelEstudo/editar/{id}', 'NivelEstudoController@edit')->name('nivel.estudo.editar');
    Route::put ('admin/nivelEstudo/update', 'NivelEstudoController@update')->name('nivel.estudo.update');
    Route::put ('admin/nivelEstudo/excluir/{id}', 'NivelEstudoController@destroy')->name('nivel.estudo.excluir');
    //Países
    Route::get ('admin/localizacao/paises', 'PaisController@index')->name('paises.selecionar');
    Route::get ('admin/localizacao/paises/cadastrar', 'PaisController@create')->name('pais.cadastrar');
    Route::post('admin/localizacao/paises/insert', 'PaisController@store')->name('pais.insert');
    Route::get ('admin/localizacao/paises/editar/{id}', 'PaisController@edit')->name('pais.editar');
    Route::put ('admin/localizacao/paises/update', 'PaisController@update')->name('pais.update');
    Route::put ('admin/localizacao/paises/excluir/{id}', 'PaisController@destroy')->name('pais.excluir');    

});
    
Route::get('admin', 'Admin\AdminController@index')->name('admin');

Route::get('/', 'Site\SiteController@index')->name('home');

Auth::routes();
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
