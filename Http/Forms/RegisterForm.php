<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class RegisterForm extends Form
{
    protected $errors = [];

    public function __construct(public array $attributes)
    {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        if (!Validator::string($attributes['firstName'], 7, 20)) {
            $this->errors['first-name'] = 'Please provide a First Name of at least seven characters.';
        }

        if (!Validator::string($attributes['lastName'], 7, 20)) {
            $this->errors['last-name'] = 'Please provide a Last Name of at least seven characters.';
        }

        if (!Validator::string($attributes['password'], 7, 20)) {
            $this->errors['password'] = 'Please provide a valid password.';
        }
    }

}