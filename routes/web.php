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
    Route::get ('admin/localizacao/pais/cadastrar', 'PaisController@create')->name('pais.cadastrar');
    Route::post('admin/localizacao/pais/insert', 'PaisController@store')->name('pais.insert');
    Route::get ('admin/localizacao/pais/editar/{id}', 'PaisController@edit')->name('pais.editar');
    Route::put ('admin/localizacao/pais/update', 'PaisController@update')->name('pais.update');
    Route::put ('admin/localizacao/pais/excluir/{id}', 'PaisController@destroy')->name('pais.excluir');
     //Estados
     Route::get ('admin/localizacao/estados', 'EstadoController@index')->name('estados.selecionar');
     Route::get ('admin/localizacao/estado/cadastrar', 'EstadoController@create')->name('estado.cadastrar');
     Route::post('admin/localizacao/estado/insert', 'EstadoController@store')->name('estado.insert');
     Route::get ('admin/localizacao/estado/editar/{id}', 'EstadoController@edit')->name('estado.editar');
     Route::put ('admin/localizacao/estado/update', 'EstadoController@update')->name('estado.update');
     Route::put ('admin/localizacao/estado/excluir/{id}', 'EstadoController@destroy')->name('estado.excluir');        
     //Cidades
     Route::get ('admin/localizacao/cidades', 'CidadeController@index')->name('cidades.selecionar');
     Route::get ('admin/localizacao/cidades/show', 'CidadeController@show')->name('cidades.show');
     Route::get ('admin/localizacao/cidade/cadastrar', 'CidadeController@create')->name('cidade.cadastrar');
     Route::post('admin/localizacao/cidade/insert', 'CidadeController@store')->name('cidade.insert');
     Route::get ('admin/localizacao/cidade/editar/{id}', 'CidadeController@edit')->name('cidade.editar');
     Route::put ('admin/localizacao/cidade/update', 'CidadeController@update')->name('cidade.update');
     Route::get ('admin/localizacao/cidade/excluir/{id}', 'CidadeController@destroy')->name('cidade.excluir');
     //Logradouros
     Route::get ('admin/localizacao/logradouros', 'LogradouroController@index')->name('logradouros.selecionar');
     Route::get ('admin/localizacao/logradouros/show', 'LogradouroController@show')->name('logradouros.show');
     Route::get ('admin/localizacao/logradouro/cadastrar', 'LogradouroController@create')->name('logradouro.cadastrar');
     Route::post('admin/localizacao/logradouro/insert', 'LogradouroController@store')->name('logradouro.insert');
     Route::get ('admin/localizacao/logradouro/editar/{id}', 'LogradouroController@edit')->name('logradouro.editar');
     Route::put ('admin/localizacao/logradouro/update', 'LogradouroController@update')->name('logradouro.update');
     Route::get ('admin/localizacao/logradouro/excluir/{id}', 'LogradouroController@destroy')->name('logradouro.excluir');                
     Route::get ('admin/localizacao/logradouro/getcidadesbyuf/{uf}', 'CidadeController@getCidadesByUf')->name('logradouro.getcidadesbyuf');

});
    
Route::get('admin', 'Admin\AdminController@index')->name('admin');

Route::get('/', 'Site\SiteController@index')->name('home');

Auth::routes();
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
