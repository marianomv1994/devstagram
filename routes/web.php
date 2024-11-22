<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Models\Comentario;
use App\Models\Follower;
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

Route::get('/home', HomeController::class)->name('home');

//rutas para el perfil

Route::get('/crear-cuenta', [RegisterController::class, 'crear']);
Route::post('/crear-cuenta', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');



//rutas para el post
route::get('/{user:username}',[PostController::class, 'index']) ->name('posts.index');
Route::get('/posts/create',[PostController::class, 'create'])->name('post.create');
route::post('/posts',[PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}',[PostController::class, 'show'])->name('posts.show');
Route::post('/{user:username}/posts/{post}',[ComentarioController::class, 'store'])->name('comentarios.store');
Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');

//ruta para imagenes
Route::post('/imagenes', [ImagenController::class,'store'])->name('imagenes.store');

//like a las fotos
Route::post('/posts/{post}/likes',[LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes',[LikeController::class, 'destroy'])->name('posts.likes.destroy');

// Siguiendo a Usuarios

Route::post('/{user:username}/follow',[FollowerController::class, 'store'])->name('user.follow');
Route::delete('/{user:username}/unfollow',[FollowerController::class, 'destroy'])->name('user.unfollow');
