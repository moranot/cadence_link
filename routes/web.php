<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;

Auth::routes();

Route::get('/', function () { return view('welcome'); });

Route::group(['middleware' => 'guest'], function () {
    Route::redirect('/user/{any}', '/auth/register')->where('any', '.*');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user/account', [UserController::class, 'show'])->name('user.account');
    Route::post('/user/delete', [UserController::class, 'delete'])->name('user.delete');
});

// Finds all files in app/resources/views/cms and adds routes to them
foreach (Storage::disk('views')->files('cms') as $file) {
    $filename = explode('.', $filename);
    Route::get('/'.$filename, function() { return view($filename); });
}
