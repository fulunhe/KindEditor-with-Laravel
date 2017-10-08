<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('rest/articleList', 'RestController@articleList');
Route::get('rest/typeList', 'RestController@typeList');
Route::get('rest/announcementList', 'RestController@announcementList');


Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ($router)
{
	$router->get('login', 'LoginController@showLoginForm')->name('admin.login');
	$router->post('login', 'LoginController@login');
	$router->post('logout', 'LoginController@logout')->name('admin.logout');
	$router->get('dash', 'DashboardController@index');

	Route::resource('articles', 'ArticlesController');
	$router->post('articles/delete', 'ArticlesController@delete');

	Route::resource('admins', 'AdminsController');
	$router->post('admins/delete', 'AdminsController@delete');

	Route::resource('users', 'UsersController');
	$router->post('users/delete', 'UsersController@delete');

	Route::resource('types', 'TypesController');
	$router->post('types/delete', 'TypesController@delete');

	Route::resource('announcements', 'AnnouncementsController');
	$router->post('announcements/delete', 'AnnouncementsController@delete');
	
});
 
