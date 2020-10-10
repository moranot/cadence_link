<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getStatusMsg(
        string $class,
        string $method,
        string $result
    ) {
        $type = strtolower($class.'.'.$method.'.'.$result);
        return [
            'type' => $type,
            'message' => __($type)
        ];
    }
}
