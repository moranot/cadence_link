<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    const MODEL = 'user';
    const STATUS_SUCCESS = 200;
    const STATUS_FAILURE = 500;

    /**
     * Show the listing of users.
     * 
     * @return View
     */
    public function index()
    { 
        return view('admin.users.index')->with('model', self::MODEL);
    }

    /**
     * Return all users.
     * 
     * @return Response
     */
    public function show()
    {
        $users = User::all();
        $headers = [];
        try {
            foreach (User::getVisible() as $header) {
                $headers[] = [
                    'text' => $header,
                    'value' => $header,
                    'sortable' => 'true'
                ];
            }
            $headers[0]['align'] = 'start';
            $status = self::STATUS_SUCCESS;
        } catch (\Exception $e) {
            $status = self::STATUS_FAILURE;
        }
        
        return response(json_encode(
            [
                'models' => $users,
                'headers' => $headers,
                'statusMsg' => $this->getStatusMsg(
                    self::MODEL,
                    __FUNCTION__,
                    $status
                ),
            ]
        ), $status);
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
        try {
            $user = User::findOrFail($id);
            if ($user->validate($request)) {
                $user->fill($request)->save();
                $status = self::STATUS_SUCCESS;
            }
        } catch (\Exception $e) {
            $status = self::STATUS_FAILURE;
        }

        return response(json_encode(
            [
                'models' => User::all(), 
                'statusMsg' => $this->getStatusMsg(
                    self::MODEL,
                    __FUNCTION__,
                    $status
                )
            ]
        ), $status);
    }

    /**
     * Delete the specified user.
     *
     * @param  string email
     * @return View
     */
    public function delete(string $email): View
    {
        try {
            $user = User::where('email', $email)->firstOrFail();
            Auth::logout();
            $user->delete();
            $status = self::STATUS_SUCCESS;
        } catch (\Exception $e) {
            $status = self::STATUS_FAILURE;
        }

        return response(json_encode(
            [
                'models' => User::all(), 
                'statusMsg' => $this->getStatusMsg(
                    self::MODEL,
                    __FUNCTION__,
                    $status
                )
            ]
        ), $status);
    }
}