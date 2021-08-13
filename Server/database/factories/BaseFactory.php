<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ybazli\Faker\Faker;

abstract class BaseFactory extends Factory
{
    /**
     * @return Faker
     */
    public function getPersianFaker(): Faker
    {
        return \Database\Factories\Faker::getInstance();
    }
}
