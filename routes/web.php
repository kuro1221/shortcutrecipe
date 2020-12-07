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
Route::get('/addRecipe', 'RecipeController@addRecipeShow')->name('addRecipeShow');
Route::post('/addRecipe', 'RecipeController@addRecipe')->name('addRecipe');
Route::get('/editRecipe/{id}', 'RecipeController@editRecipeShow');
Route::post('/editRecipe/{id}', 'RecipeController@editRecipe');
Route::get('/recipeList', 'RecipeController@recipeListShow')->name('recipeListShow');
