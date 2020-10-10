<?php

namespace App\Models;

use Illuminate\Validation\Validator;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $rules = array();
    protected $errors;

    public function validate($data)
    {
        $validator = Validator::make($data, $this->rules);

        if ($validator->fails())
        {
            $this->errors = $validator->errors;
            return false;
        }

        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}