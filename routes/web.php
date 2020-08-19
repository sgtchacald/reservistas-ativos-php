<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

route::group(['middleware' => ['auth'],'namespace'  => 'Admin'],function(){
    Route::get('admin/reservistas', 'UsuarioController@getUsuariosReservistasAtivos')->name('reservistas.selecionar');
    Route::get('admin/reservista/cadastrar', 'UsuarioController@create')->name('reservista.cadastrar');
    Route::post('admin/reservista/insert', 'UsuarioController@store')->name('reservista.insert');
    Route::get('admin/reservista/editar/{idusuario}', 'UsuarioController@edit')->name('reservista.editar');
    Route::put('admin/reservista/update', 'UsuarioController@update')->name('reservista.update');
    Route::put('admin/reservista/excluir/{idusuario}', 'UsuarioController@destroy')->name('reservista.excluir');
});
    
Route::get('admin', 'Admin\AdminController@index')->name('admin');

Route::get('/', 'Site\SiteController@index')->name('home');

Auth::routes();
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
