<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ListImageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShowAuthorController;
use App\Http\Controllers\ShowImageController;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', ListImageController::class)->name('image.all');
Route::get("images/{image:slug}/show-image", ShowImageController::class)->name('image-show');

Route::resource('account/image', ImageController::class)->except('show');

Route::get('account/image/download/{image}', function($image){
    $path = asset($image);
    return Storage::download('lcqrWqkEXeZowFsbwrDYg7ojwGCXLHJk3VfJWhhK.jpg');

})->name('download.image');

// Route::get('/images', [ImageController::class, 'index'])->name('image.index');
// Route::get("images/{image:slug}/show", [ImageController::class, "show"])->name('image.show');
// Route::get('images/create', [ImageController::class, 'create'])->name('image.create');
// Route::post('images/store', [ImageController::class, 'store'])->name('image.store');


// Route::get('images/{image}/edit', [ImageController::class, 'edit'])->name('image.edit');
// Route::put('images/{image}/update', [ImageController::class, 'update'])->name('image.update');
// Route::delete('images/{image}/destroy', [ImageController::class, 'destroy'])->name('image.destroy');

Route::get('account/settings', [SettingController::class, 'edit'])->name('settings.edit');
Route::put('account/settings/update', [SettingController::class, 'update'])->name('settings.update');
Route::get('/@{user:username}', ShowAuthorController::class)->name('author.show');



Route::view('/test-component', 'welcome');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
