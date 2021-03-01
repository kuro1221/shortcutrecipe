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

Route::get('/', 'RecipeController@recipeListShow')->name('recipeListShow');

Auth::routes();

// Route::get('/', 'HomeController@index')->name('home');

Route::get('/auth/passwords/successful', 'Auth\ResetPasswordController@showSuccessful');

//ユーザー関係
Route::get('/userDetail/{id}', 'UserController@userDetailShow')->name('userDetailShow');
Route::get('/profileEdit', 'UserController@profileEditShow')->name('profileEditShow');
Route::post('/profileEdit', 'UserController@profileEdit');
Route::get('/passwordEdit', 'UserController@passwordEditShow')->name('passwordEditShow');
Route::post('/passwordEdit', 'UserController@passwordEdit');
Route::get('/withdrawalShow', 'UserController@withdrawalShow')->name('withdrawalShow');
Route::post('/withdrawal', 'UserController@withdrawal');


//レシピ
Route::get('/addRecipe', 'RecipeController@addRecipeShow')->name('addRecipeShow');
Route::post('/addRecipe', 'RecipeController@addRecipe')->name('addRecipe');
Route::get('/editRecipe/{id}', 'RecipeController@editRecipeShow');
Route::post('/editRecipe/{id}', 'RecipeController@editRecipe');
Route::get('/recipeList', 'RecipeController@recipeListShow')->name('recipeListShow');
Route::post('/deleteRecipe/{id}', 'RecipeController@deleteRecipe');

// LINEの認証画面に遷移
Route::get('auth/line', 'Auth\LineOAuthController@redirectToProvider')->name('line.login');
// 認証後にリダイレクトされるURL(コールバックURL)
Route::get('auth/line/callback', 'Auth\LineOAuthController@handleProviderCallback');

