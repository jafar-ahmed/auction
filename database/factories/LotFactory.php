<?php

namespace Database\Factories;

use App\Models\Lot;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class LotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $faker = new Faker;
        $now = now();

        return [
            'name' => $faker->title(),
            'slug' => $faker->unique()->slug,
            'description' => $faker->text(),
            'category_id' => $faker->text(),
            'img' => $faker->image('public/'),
            'price' => $faker->text(),
            'step' => $faker->text(),
            'dt_end' => $faker->text(),
            'user_id' => $faker->text(),
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }
}
