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

Route::pattern('id', '[0-9]+');
Route::pattern('rank', '[0-9]+');

Route::get('/news', 'NewController@index')->name('news.index');
Route::get('/news/{id}', 'NewController@show')->name('news.show');
Route::get('/product', 'ProductController@index')->name('product.index');
Route::get('/product/{id}', 'ProductController@show')->name('product.show');
Route::get('/product/type/{type}', 'ProductController@index_type')->name('product_type.index');
Route::get('/video', 'VideoController@index')->name('video.index');
Route::get('/video/{id}', 'VideoController@show')->name('video.show');
Route::get('/ranking/{rank}', 'ProductController@index_ranking')->name('ranking.index');
Route::post('/order/re', 'OrderController@index_re')->name('order.index_re');
Route::get('/order/re', 'OrderController@index_re')->name('order.index_re');
Route::post('/order/receive', 'OrderController@store')->name('order.store');
Route::get('/', 'ProductController@index_home')->name('index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/error', function () {
    return view('error');
})->name('error');
Route::get('lang/{lang}', function ($lang) {
    App::setLocale($lang);
    Session::put('locale', $lang);
    return redirect()->back();
})->name('lang');

Route::middleware('auth')->group(function () {
    $this->post('/order/create/{id}', 'OrderController@create')->name('order.create');
    $this->get('/my/order', 'OrderController@index_img')->name('my_order.index');
    $this->get('/my/product', 'ProductController@index_my')->name('my_product.index');
    $this->get('/information', 'MemberController@show')->name('member.show');
    $this->get('/information/edit', 'MemberController@edit')->name('member.edit');
    $this->get('/password/edit', 'MemberController@edit_pass')->name('member.pass.edit');
    $this->patch('/password/patch', 'MemberController@update_pass')->name('member.pass.update');
    $this->patch('/information', 'MemberController@update')->name('member.update');
    $this->get('/collect', 'CollectController@index')->name('collect.index');
    $this->post('/collect/store/{id}', 'CollectController@store')->name('collect.store');
    $this->delete('/collect/{id}/delete', 'CollectController@destroy')->name('collect.destroy');
    $this->get('/order', 'OrderController@index')->name('order.index');
    $this->post('/review/store', 'ProductController@store_review')->name('review.store');
    $this->get('/apply/create', 'MemberController@create')->name('creator.create');
    $this->get('/Download/{download}', 'ProductController@download')->name('product.download');

});

Route::middleware('auth.creator')->group(function () {
    $this->get('/product/management', 'ProductController@management')->name('management.index');
    $this->get('/product/create', 'ProductController@create')->name('product.create');
    $this->post('/product/store', 'ProductController@store')->name('product.store');
    $this->get('/product/{id}/edit', 'ProductController@edit')->name('product.edit');
    $this->post('/product/{id}/patch', 'ProductController@update')->name('product.update');
    $this->get('/article/create', 'ArticleController@create')->name('article.create');
    $this->post('/article/store', 'ArticleController@store')->name('article.store');
    $this->get('/article/{id}/edit', 'ArticleController@edit')->name('article.edit');
    $this->patch('/article/{id}/patch', 'ArticleController@update')->name('article.update');
    $this->delete('/article/{id}/delete', 'ArticleController@destroy')->name('article.destroy');
    $this->post('/message/store', 'MessageController@store')->name('message.store');
    $this->delete('/message/{id}/delete', 'MessageController@destroy')->name('message.destroy');
    $this->get('/article', 'ArticleController@index')->name('article.index');
    $this->get('/article/{id}', 'ArticleController@show')->name('article.show');
    $this->get('/product/record/{id}', 'ProductController@show_record')->name('product.record');
    $this->get('/report', 'OrderController@index_report')->name('report.index');
    $this->get('/report/{date}', 'OrderController@index_report')->name('report.index');
});
Auth::routes();
Route::middleware('auth.admin:admin')->group(function () {
    $this->get('/news/create', 'NewController@create')->name('new.create');
    $this->post('/news/store', 'NewController@store')->name('new.store');
    $this->get('/news/{id}/edit', 'NewController@edit')->name('new.edit');
    $this->patch('/news/{id}/patch', 'NewController@update')->name('new.update');
    $this->delete('/news/{id}/delete', 'NewController@destroy')->name('new.destroy');
    $this->get('/admin/article', 'ArticleController@index')->name('admin.article.index');
    $this->get('/admin/article/{id}', 'ArticleController@show')->name('admin.article.show');
    $this->get('/admin/product/record/{id}', 'ProductController@show_record')->name('admin.product.record');
});
Route::prefix('admin')->namespace('Admin')->group(function () {
    $this->get('login', 'LoginController@showLoginForm')->name('admin.login');
    $this->post('login', 'LoginController@login');
    $this->get('logout', 'LoginController@logout');
    $this->post('logout', 'LoginController@logout')->name('admin.logout');

    Route::middleware('auth.admin:admin')->group(function () {
        $this->get('news', 'AdminController@index_new')->name('admin.new');
        $this->get('creator', 'AdminController@index_creator')->name('admin.creator');
        $this->patch('creator/{id}/patch', 'AdminController@update_creator')->name('admin.creator.update');
        $this->get('product', 'AdminController@index_product')->name('admin.product');
        $this->get('product/apply', 'AdminController@index_product_apply')->name('admin.product.apply');
        $this->get('member', 'AdminController@index_member')->name('admin.member');
        $this->patch('member/{id}/patch', 'AdminController@update_member')->name('admin.member.update');
        $this->patch('/product/{id}/patch', 'AdminController@update_product')->name('admin.product.update');
        $this->patch('/product/apply/{id}/patch', 'AdminController@update_product_apply')->name('admin.product.apply.update');
        $this->get('/information/{id}', 'AdminController@show_member')->name('admin.member.show');
        $this->delete('/article/{id}/delete', 'AdminController@destroy_article')->name('admin.article.destroy');
        $this->delete('/message/{id}/delete', 'AdminController@destroy_message')->name('admin.message.destroy');
        $this->get('/report', 'AdminController@index_report');
        $this->get('/report/{date}', 'AdminController@index_report')->name('admin.report.index');
        $this->get('/Download/{id}', 'AdminController@download')->name('admin.product.download');
    });
    Route::middleware('auth.admin:admin')->name('admin.')->group(function () {
        $this->get('/', 'IndexController@index');
    });
});

Route::get('/englishvr/playrecord', 'EnglishVR\PlayrecordController@index')->name('englishvr.playrecord');
Route::get('/englishvr/login', 'EnglishVR\LoginController@showLoginForm')->name('englishvr.login');
Route::post('/englishvr/login', 'EnglishVR\LoginController@login');
Route::get('/englishvr/logout', 'EnglishVR\LoginController@logout');
Route::post('/englishvr/logout', 'EnglishVR\LoginController@logout')->name('englishvr.logout');

Route::post('/englishgame/login', 'Englishgame\MemberController@index')->name('englishgame.login');
Route::post('/englishgame/coursestudent', 'Englishgame\MemberController@show_coursestudent')->name('coursestudent.show');
Route::post('/englishgame/LevelRecord', 'Englishgame\MemberController@store_LevelRecord')->name('LevelRecord.store');
Route::post('/englishgame/ErrorRecord', 'Englishgame\MemberController@store_ErrorRecord')->name('ErrorRecord.store');
Route::post('/englishgame/PlayRecord', 'Englishgame\MemberController@store_PlayRecord')->name('PlayRecord.store');
Route::post('/englishgame/CourseStudent', 'Englishgame\MemberController@store_CourseStudent')->name('CourseStudent.store');

