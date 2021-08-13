<?php

namespace App\Exceptions;

class InvalidAuthException extends SpecialException
{
    protected $code = 401;
    protected $message = 'نام کاربری یا رمز عبور نامعتبر است.';
    protected $error = 'invalid_credentials';
}
