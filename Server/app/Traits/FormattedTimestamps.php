<?php


namespace App\Traits;


use App\Casts\DateTimeJalaliAndGregorianCast;

trait FormattedTimestamps
{
    public function getCreatedAtAttribute($value)
    {
        $cast = new DateTimeJalaliAndGregorianCast();
        return $cast->get($this, 'created_at', $value, []);
    }

    public function getUpdatedAtAttribute($value)
    {
        $cast = new DateTimeJalaliAndGregorianCast();
        return $cast->get($this, 'updated_at', $value, []);
    }
}
