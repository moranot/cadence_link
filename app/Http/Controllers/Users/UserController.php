<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }


        //
    public function delete($id)
    {
        $user = User::find(Auth::user()->id);
        Auth::logout();
        $messageValue = 'There was an issue with deleting your account. Please contact our support email for more inforamtion';
        if ($user->delete()) {
            $messageValue = 'Your account has been deleted!';
        }

        return view('user.delete')->with('message', $messageValue);
    }
}