<?php

namespace Database\Factories;

use Domains\Product\Models\PricePlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PricePlan>
 */
class PricePlanFactory extends Factory
{
    protected $model = PricePlan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid,
            'name' => $this->faker->name,
            'description' => $this->faker->text,
        ];
    }
}
