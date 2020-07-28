<?php

use Illuminate\Support\Facades\Route;
use App\Post;
use App\User;
use App\Role;

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

// Route::resource('posts', 'PostsController');

Route::get('contact', 'PostsController@contact');

Route::get('post/{id}/{name}/{pass}', 'PostsController@show_post');

Route::get('/insert', function(){
    $post = new Post;

    $post->title = "Ruby";
    $post->content = "Rails framework";
    $post->save();
});

Route::get('/create', function() {
    Post::create(['title'=>'C', 'content'=>'nanimonai']);
});

Route::get('/delete', function(){
    Post::destroy(2);
});

Route::get('/softdelete', function(){
    Post::find(4)->delete();
});

Route::get('/read', function(){
    $result = DB::select('select *from posts where id=?', [4]);
    return $result;
});

Route::get('/readsoft', function(){
    // $post = Post::withTrashed()->where('is_admin', 0)->get();
    // return $post;

    $post = Post::onlyTrashed()->where('is_admin', 0)->get();
    return $post;
});

Route::get('/find', function(){
    $post = Post::find(2);
    return $post->title;
});

Route::get('/restore', function(){
    Post::withTrashed()->where('is_admin', 0)->restore();
});

Route::get('/forcedelete', function(){
    Post::withTrashed()->where('title', 'Ruby')->forcedelete();
});

//1-1 relationship
Route::get('/user/{id}/post', function($id) {
    return User::find($id)->post->content;
});

Route::get('/post/{id}/user', function($id) {
    return Post::find($id)->user->name;
});

//1-n realationship
Route::get('/posts', function() {
    $user = User::find(1);
    foreach($user->posts as $post) {
        echo $post->title.'<br/>';
    }
});

//n-n relationship
Route::get('/user/{id}/role', function($id) {
    $user = User::find($id)->roles()->orderBy('id', 'desc')->get();
    return $user;
    // foreach($user->roles as $role) {
    //     return $role->name;
    // }
});

Route::get('user/pivot', function() {
    $user = User::find(1);
    foreach($user->roles as $role) {
        return $role->pivot->created_at;
    }
});

Route::get('user/country', function() {
    
});