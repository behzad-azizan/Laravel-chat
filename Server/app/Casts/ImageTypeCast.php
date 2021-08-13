<?php

namespace App\Casts;

use App\Models\ProductImage;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ImageTypeCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, $attributes)
    {
        $sexes = array_flip(ProductImage::getTypes());
        return $sexes[$value] ?? null;
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
    public function set($model, string $key, $value, $attributes)
    {
        return ProductImage::getTypes()[$value] ?? null;
    }
}
