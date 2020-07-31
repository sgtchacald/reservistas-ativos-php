<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

route::group(['middleware' => ['auth'],'namespace'  => 'Admin'],function(){
    Route::get('admin/reservista/{permissaoUsuario}/{indStatus}', 'UsuarioController@index')->name('reservista.selecionar');
    Route::get('admin/reservista/cadastrar', 'UsuarioController@create')->name('reservista.cadastrar');
    Route::post('admin/reservista/insert', 'UsuarioController@store')->name('reservista.insert');
});
    
Route::get('admin', 'Admin\AdminController@index')->name('admin');

Route::get('/', 'Site\SiteController@index')->name('home');

Auth::routes();