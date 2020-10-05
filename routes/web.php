<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::group(['middleware' => 'guest'], function () {
    Route::redirect('/user/{any}', '/auth/register')->where('any', '.*');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user/account', [UserController::class, 'show'])->name('user.account');
    Route::post('/user/delete', [UserController::class, 'delete'])->name('user.delete');
});

// Finds all files in app/resources/views/cms and adds route to them
foreach (Storage::disk('views')->files('cms') as $file) {
    $filename = explode('.', $filename);
    Route::get('/'.$filename, function() { return view($filename); });
}
