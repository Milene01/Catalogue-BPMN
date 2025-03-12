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

use Illuminate\Support\Facades\Auth;

Route::get('/', 'AboutController@index')->name('home');

Route::get('/manager', function()
{
    if(\Illuminate\Support\Facades\Gate::allows('rule','team'))
    {
        return redirect('/team/publication');
    }
    return view('login');

});

Route::get('/ajax/publication/list',function(){
    $publication = \App\Publication::select('id','authors','publications_id')->where('approved','=',true)->orderBy('publications_id')->get()->toJson();
    return str_replace('null',$publication);
});


/**
 * Authentication System using Social Login
 */
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');


Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route('home');
});

Route::get('/construct/list', 'WelcomeController@constructs');

Route::get('/conflict/list', 'WelcomeController@conflicts');

Route::get('/publication/list', 'WelcomeController@publications');

Route::get('/publication/treeview', 'WelcomeController@treeview');

Route::get('/suggest' ,'SuggestController@index');

Route::post('/suggest','SuggestController@submitPaper');

Route::get('/suggest/publication/{id}','SuggestController@suggestUpdate');

Route::post('/suggest/publication/{id}','SuggestController@suggestUpdateSave');

Route::get('/about', 'AboutController@index');

Route::group(['middleware' => 'auth'], function () {

    //admin routes
    Route::get('/admin/user', 'Admin\UserController@index');
    Route::get('/admin/user/edit/{id}','Admin\UserController@edit');
    Route::post('/admin/user/save','Admin\UserController@save');

    Route::get('/admin/category', 'Admin\CategoryController@index');
    Route::get('/admin/category/edit/{id?}','Admin\CategoryController@edit');
    Route::post('/admin/category/save','Admin\CategoryController@save');

    Route::get('/admin/quality', 'Admin\QualityController@index');
    Route::get('/admin/quality/edit/{id?}','Admin\QualityController@edit');
    Route::post('/admin/quality/save','Admin\QualityController@save');

    Route::get('/team/tag', 'Team\TagController@index');
    Route::get('/team/tag/edit/{id?}','Team\TagController@edit');
    Route::post('/team/tag/save','Team\TagController@save');

    Route::get('/team/classification', 'Team\ClassificationController@index');
    Route::get('/team/classification/edit/{id?}','Team\ClassificationController@edit');
    Route::post('/team/classification/save','Team\ClassificationController@save');

    Route::get('/team/conflict', 'Team\ConflictController@index');
    Route::get('/team/conflict/edit/{id?}','Team\ConflictController@edit');
    Route::post('/team/conflict/save','Team\ConflictController@save');
    Route::get('/team/conflict/autocomplete', 'Team\ConflictController@autoComplete');

    Route::get('/team/representationform', 'Team\RepresentationFormController@index');
    Route::get('/team/representationform/edit/{id?}','Team\RepresentationFormController@edit');
    Route::post('/team/representationform/save','Team\RepresentationFormController@save');

    Route::get('/team/publication','Team\PublicationController@index');
    Route::get('/team/publication/accepted','Team\PublicationController@accepted');
    Route::get('/team/publication/rejected','Team\PublicationController@rejected');
    Route::get('/team/publication/autocomplete','Team\PublicationController@autoComplete');

    Route::get('/team/publication/accept/{id}','Team\PublicationController@accept');
    Route::get('/team/publication/reject/{id}','Team\PublicationController@reject');

    Route::get('/publication/create','Team\PublicationController@create');
    Route::get('/publication/edit/{id}','Team\PublicationController@edit');
    Route::post('/publication/save','Team\PublicationController@save');

    Route::get('/publication/quality/{id}','Team\PublicationController@quality');
    Route::post('/publication/quality','Team\PublicationController@qualitySave');

    Route::get('/publication/item/insert/{publicationId}/{categoryId}/{imageId?}','Team\PublicationController@insertItem');
    Route::post('/publication/item/save/{publicationId}/{categoryId}/{imageId?}','Team\PublicationController@saveItem');

    Route::get('/publication/image/insert/{publicationId}/{categoryId}/{imageId?}','Team\PublicationController@insertImage');
    Route::post('/publication/image/save/{publicationId}/{categoryId}/{imageId?}','Team\PublicationController@saveImage');
    Route::get('/publication/image/show/{imageId}','Team\PublicationController@showImage');

    Route::get('/publication/construct/insert/{publicationId}/{constructId?}','Team\PublicationController@insertConstruct');
    Route::post('/publication/construct/save','Team\PublicationController@saveConstruct');

});

Route::get('/publication/view/{id}','PublicationController@view');
Route::get('/publication/treeview/{id}','PublicationController@treeview');
Route::get('/publication/construct/show/{constructId}/{mode?}','PublicationController@showConstruct');
Route::get('/publication/conflict/show/{conflictId}','PublicationController@showConflict');