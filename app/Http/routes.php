<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

get('/', function () {
    return redirect('/news');
});

get('news', 'NewsController@index');
get('news/{id}', ['uses' => 'NewsController@show', 'as' => 'newsShow']);

// Admin area
get('admin', function () {
    return redirect('/admin/news');
});

post('/comment/destroy','CommentController@destroy');

post('/comment/verify', 'CommentController@verify');


$router->group(['namespace' => 'Admin', 'middleware' => 'auth'], function () {

    post('admin/user/change',['uses' => 'UserController@change', 'as' => 'admin.user.change']);
    get('admin/user/editRole/{id}',['uses' => 'UserController@editRole', 'as' => 'admin.user.editRole']);
    post('admin/user/updateRole/{id}',['uses' => 'UserController@updateRole', 'as' => 'admin.user.updateRole']);

    get('admin/role/editPermission/{id}',['uses' => 'RoleController@editPermission', 'as' => 'admin.role.editPermission']);
    post('admin/role/updatePermission/{id}',['uses' => 'RoleController@updatePermission', 'as' => 'admin.role.updatePermission']);

    post('admin/newsupload/uploadImgFile', 'NewsUploadController@uploadImgFile');


    resource('admin/user','UserController');
    resource('admin/role','RoleController');
    resource('admin/permission','PermissionController');
    resource('admin/resource','ResourceController');

    get('admin/jrsx/search',['uses'=>'JrsxController@search','as'=>'admin.jrsx.search']);
    get('admin/jrsx/fav',['uses'=>'JrsxController@fav','as'=>'admin.jrsx.fav']);
    get('admin/jrsx/remark',['uses'=>'JrsxController@remark','as'=>'admin.jrsx.remark']);
    resource('admin/jrsx','JrsxController');

    get('admin/news/search',['uses'=>'NewsController@search','as'=>'admin.news.search']);
    resource('admin/news', 'NewsController', ['except' => 'show']);

    resource('admin/pro', 'ProController',['except' => 'show']);

    get('admin/comment/search',['uses'=>'CommentController@search','as'=>'admin.comment.search']);
    resource('admin/comment', 'CommentController', ['except' => 'show']);



    get('admin/upload', 'UploadController@index');
    post('admin/upload/file', 'UploadController@uploadFile');
    delete('admin/upload/file', 'UploadController@deleteFile');
    post('admin/upload/folder', 'UploadController@createFolder');
    delete('admin/upload/folder', 'UploadController@deleteFolder');


});

// Logging in and out
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');