<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    /**
     * Check the operation is update or create
     * @return bool
     */
    protected function isUpdate()
    {
        return ! is_null($this->getId());
    }

    /**
     * @return int
     */
    protected function getId()
    {
        return request()->route('id');
    }
}
