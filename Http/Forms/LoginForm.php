<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm extends Form
{
    protected $errors = [];

    public function __construct(public array $attributes)
    {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Please provide a valid password.';
        }
    }
}