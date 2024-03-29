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

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'HomeController@introducePageShow')->name('introducePageShow');
Route::get('/introducePage', 'HomeController@introducePageShow')->name('introducePageShow');

Auth::routes();

Route::get('/auth/passwords/successful', 'Auth\ResetPasswordController@showSuccessful');

//ユーザー関係
Route::get('/guestLogin', 'Auth\LoginController@guestLogin');
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
