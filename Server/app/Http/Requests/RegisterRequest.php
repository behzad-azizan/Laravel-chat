<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends BaseRequest
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
            'name' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'alpha_dash', 'max:100', Rule::unique('users', 'username')],
            'password' => ['required', 'string', 'confirmed', Password::min(8)]
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
