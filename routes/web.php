<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

route::group(
    [
        'middleware' => ['auth'],
        'namespace'  => 'Admin'
    ],
    function(){
        
});
    
Route::get('admin', 'Admin\AdminController@index')->name('admin');

Route::get('/', 'Site\SiteController@index')->name('home');

Auth::routes();