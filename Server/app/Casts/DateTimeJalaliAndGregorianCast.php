<?php

namespace App\Casts;

use App\Models\Worker;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DateTimeJalaliAndGregorianCast implements CastsAttributes
{

    private string $format;

    public function __construct($format = null)
    {
        $this->format = ($format ? $format : \C::DATE_TIME_FORMAT);
    }

    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, $key, $value, $attributes)
    {
        return [
            'gregorian' => $value ? Carbon::make($value)->format($this->format) : $value,
            'jalali' => $value ? to_jalali($value, $this->format) : $value,
            'diff_for_humans' => $value ? ago(strtotime($value)) : null
        ];
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, $key, $value, $attributes)
    {
        if (is_array($value)) {
            if (isset($value['gregorian']))
                return $value['gregorian'];

            return null;
        }
        return $value;
    }
}
