<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SendMessageRequest extends BaseRequest
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
            'message' => ['required', 'string', 'max:5000', 'min:1'],
            'recipient_id' => ['required', 'integer', Rule::exists('users', 'id')->whereNot('id', Auth::id())]
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
