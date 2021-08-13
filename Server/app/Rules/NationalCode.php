<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class NationalCode implements Rule
{
    /**
     * @var Request
     */
    private Request $request;

    /**
     * Create a new rule instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request = null)
    {
        $this->request = $request ?? \request();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        switch ($this->request->get('nationality')) {
            default :
                return $this->iranNationalValidation($value);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute نامعتبر است.';
    }

    /**
     * @param $value
     * @return bool
     */
    protected function iranNationalValidation($value)
    {
        if(!preg_match('/^[0-9]{10}$/',$value))
            return false;

        for($i=0;$i<10;$i++)
            if(preg_match('/^'.$i.'{10}$/',$value))
                return false;

        for($i=0, $sum=0; $i<9; $i++)
            $sum += ((10 - $i) * intval(substr($value, $i,1)));

        $ret = $sum % 11;
        $parity = intval(substr($value, 9,1));

        if(($ret < 2 && $ret == $parity) || ($ret >= 2 && $ret == 11 - $parity))
            return true;

        return false;
    }

    /**
     * @param $value
     * @return false|int
     */
    protected function foreignCitizensValidation($value)
    {
        return preg_match('/^[0-9]{13}$/',$value);
    }
}
