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
/*
get('png', function () {
    ob_clean();
    ob_start();
    $im = @imagecreate(200, 50) or die("创建图像资源失败");
    imagecolorallocate($im, 255, 255, 255);
    $text_color = imagecolorallocate($im, 0, 0, 255);
    imagestring($im, 5, 0, 0, "Hello world!", $text_color);
    imagepng($im);
    imagedestroy($im);
    $content = ob_get_clean();
    return response($content, 200, [
        'Content-Type' => 'image/png',
    ]);
});

get('/', function(){
    return redirect('/admin/news');
});
*/
get('/', ['uses'=>'Admin\NewsController@index','middleware' => 'auth']);
get('news', 'NewsController@index');
get('news/{id}', ['uses' => 'NewsController@show', 'as' => 'newsShow']);

// Admin area

post('/comment/destroy','CommentController@destroy');

post('/comment/verify', 'CommentController@verify');


$router->group(['namespace' => 'Admin', 'middleware' => 'auth'], function () {

    get('admin', 'NewsController@index');
    post('admin/user/change',['uses' => 'UserController@change', 'as' => 'admin.user.change']);
    get('admin/user/editRole/{id}',['uses' => 'UserController@editRole', 'as' => 'admin.user.editRole']);
    post('admin/user/updateRole/{id}',['uses' => 'UserController@updateRole', 'as' => 'admin.user.updateRole']);

    get('admin/user/editPro/{id}',['uses' => 'UserController@editPro', 'as' => 'admin.user.editPro']);
    post('admin/user/updatePro/{id}',['uses' => 'UserController@updatePro', 'as' => 'admin.user.updatePro']);

    get('admin/role/editPermission/{id}',['uses' => 'RoleController@editPermission', 'as' => 'admin.role.editPermission']);
    post('admin/role/updatePermission/{id}',['uses' => 'RoleController@updatePermission', 'as' => 'admin.role.updatePermission']);

    post('admin/newsupload/uploadImgFile', 'NewsUploadController@uploadImgFile');


    resource('admin/user','UserController');
    resource('admin/role','RoleController');
    resource('admin/permission','PermissionController');


    get('admin/jrsx/search',['uses'=>'JrsxController@search','as'=>'admin.jrsx.search']);
    get('admin/jrsx/fav',['uses'=>'JrsxController@fav','as'=>'admin.jrsx.fav']);
    get('admin/jrsx/remark',['uses'=>'JrsxController@remark','as'=>'admin.jrsx.remark']);
    resource('admin/jrsx','JrsxController');

    get('admin/news/search',['uses'=>'NewsController@search','as'=>'admin.news.search']);
    resource('admin/news', 'NewsController', ['except' => 'show']);

    resource('admin/pro', 'ProController',['except' => 'show']);
    resource('admin/dept', 'DeptController',['except' => 'show']);

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