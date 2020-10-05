<?php

namespace App\Traits;

use Illuminate\Validation\Validator;

trait ValidatorTrait
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