<?php


namespace App\Exceptions;


class SpecialException extends \Exception
{
    protected $code = 500;

    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->error;
    }
}
