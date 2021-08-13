<?php

namespace App\Http\Requests;


class LoginRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->isUpdate() ?
                    $this->updateRules() :
                    $this->baseRules();
    }

    /**
     * Get create rules
     * @return array
     */
    protected function baseRules()
    {
        return [

        ];
    }

    /**
     * Get update rules
     * @return array
     */
    protected function updateRules()
    {
        $baseRules = $this->baseRules();
        $updateRules = [

        ];

        return array_merge($baseRules, $updateRules);
    }
}
