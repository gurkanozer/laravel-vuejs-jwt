<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
//CONTROLLERS
//Backend
use App\Http\Controllers\PagesController as Pager;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\StaticPageController;
//Frontend
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\StaticPageController as SPController;
use App\Http\Controllers\Frontend\DetailPageController;



//API ROUTES
Route::middleware('auth')->prefix('/api')->group(function(){
    //USER ROLES
    Route::get('get_roles',[RoleController::class,'index']);
    Route::get('get_roles/{id}',[RoleController::class,'index']);
    Route::post('add_role',[RoleController::class,'create']);
    Route::post('edit_role',[RoleController::class,'update']);
    Route::post('delete_role',[RoleController::class,'delete']);
    Route::post('edit_permissions',[RoleController::class,'updatePermissions']);
    //CATEGORIES
    Route::get('get_categories',[CategoryController::class,'index']);
    Route::get('get_categories/{id}',[CategoryController::class,'index']);
    Route::post('add_category',[CategoryController::class,'create']);
    Route::post('edit_category',[CategoryController::class,'update']);
    Route::post('delete_category',[CategoryController::class,'delete']);
    //USERS
    Route::get('get_users',[UserController::class,'index']);
    Route::get('get_users/{id}',[UserController::class,'index']);
    Route::post('add_user',[UserController::class,'create']);
    Route::post('edit_user',[UserController::class,'update']);
    Route::post('delete_user',[UserController::class,'delete']);
    Route::post('change_password',[UserController::class,'changePassword']);
    //TAGS
    Route::get('get_tags',[TagController::class,'index']);
    Route::get('get_tags/{id}',[TagController::class,'index']);
    Route::post('add_tag',[TagController::class,'create']);
    Route::post('edit_tag',[TagController::class,'update']);
    Route::post('delete_tag',[TagController::class,'delete']);
    //POSTS
    Route::get('get_posts',[PostController::class,'index']);
    Route::get('get_posts/{id}',[PostController::class,'index']);
    Route::post('add_post',[PostController::class,'create']);
    Route::post('edit_post',[PostController::class,'update']);
    Route::post('delete_post',[PostController::class,'delete']);
    //SETTINGS
    Route::get('get_settings',[SettingController::class,'index']);
    Route::post('edit_settings',[SettingController::class,'update']);
    //STATIC_PAGES
    Route::get('get_static_pages',[StaticPageController::class,'index']);
    Route::get('get_static_pages/{id}',[StaticPageController::class,'index']);
    Route::post('edit_static_pages',[StaticPageController::class,'update']);
});

//ROUTES
Route::get('/v1/{any1}',[Pager::class,'index']);
Route::get('/v1/{any1}/{any2}',[Pager::class,'index']);
Route::get('/v1/{any1}/{any2}/{any3}',[Pager::class,'index']);

Route::get('/',[HomeController::class,'index']);
Route::get('/{page}',[SPController::class,'index']);
Route::get('/{category_slug}/{title_slug}',[DetailPageController::class,'index']);