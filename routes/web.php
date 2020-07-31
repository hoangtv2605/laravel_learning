<?php

use Illuminate\Support\Facades\Route;
use App\Post;
use App\User;
use App\Role;
use App\Country;
use App\Photo;
use App\Tag;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|sudo composer create-project laravel/laravel onetoone --prefer-dist

*/


Route::get('/', function () {
    return view('welcome');
});

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
    $country = Country::find(1); 
    foreach($country->posts as $post) {
        return $post->content;
    }
});

Route::get('post/{id}/photos', function($id) {
    $post = Post::find($id);
    foreach($post->photos as $photo) {
        return $photo;
    }
});

Route::get('user/photos', function() {
    $user = User::find(1);
    foreach($user->photos as $photo) {
        return $photo;
    }
});

Route::get('photo/{id}/post', function($id) {
    $photo = Photo::findOrFail($id);
    return $photo->imageable;
});

Route::get('post/tag', function() {
    $post = Post::find(1);
    foreach($post->tags as $tag) {
        return $tag;
    }
});

Route::get('tag/post', function() {
    $tag = Tag::find(2);
    foreach($tag->posts as $post) {
        return $post->title;
    }
});

Route::group(['middleware'=>'web'], function(){
    Route::resource('/posts', 'PostsController');
});

Route::get('date', function(){
    $date = new DateTime('+1 week');
    echo $date->format('m-d-Y');
    echo '<br/>';
    echo Carbon::now('Asia/Ho_Chi_Minh')->addDays(21)->diffForHumans();
    echo '<br/>';
    echo Carbon::now('Asia/Ho_Chi_Minh')->subMonths(5)->diffForHumans();
    echo '<br/>';
    echo Carbon::now('Asia/Ho_Chi_Minh')->yesterday()->diffForHumans();
});

Route::get('getname', function() {
    $user = User::find(1);
    echo $user->name;
});

Route::get('setname', function() {
    $user = User::find(1);
    $user->name = 'huy';
    $user->save();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
