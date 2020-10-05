<?php

namespace App\Http\Controllers\Users;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    const STAT_CREATE_SUCCESS = 'statuses.user.create.failure';
    const STAT_CREATE_FAILURE = 'statuses.user.create.failure';
    const STAT_UPDATE_SUCCESS = 'statuses.user.update.success';
    const STAT_UPDATE_FAILURE = 'statuses.user.update.failure';
    const STAT_DELETE_SUCCESS = 'statuses.user.delete.success';
    const STAT_DELETE_FAILURE = 'statuses.user.delete.failure';

    /**
     * Show account details of specified user.
     *
     * @param  int  $id
     * @return View
     */
    public function show(int $id): View
    {
        return view('user.account', [
            'user' => User::findOrFail(Auth::user()->id)
        ]);
    }

    /**
     * Create the specified user.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.user.create');
    }

    /**
     * Update the specified user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        $user = User::find(Auth::user()->id);
        $status = self::STATUS_FAILURE;
        if ($user->validate($request)) {
            $user->fill($request)->save();
            $status = self::STATUS_SUCCESS;
        }
        $request->session()->flash('status', $status);
        return redirect()->back();
    }

    /**
     * Delete the specified user.
     *
     * @param  string email
     * @return View
     */
    public function delete(string $email): View
    {
        $user = User::where('email', $email);
        Auth::logout();
        $messageValue = 'There was an issue with deleting your account. Please contact our support email for more information';
        
        if ($user->delete()) {
            $messageValue = 'Your account has been deleted!';
        }

        return view('user.delete')->with('message', $messageValue);
    }
}