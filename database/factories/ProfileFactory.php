<?php

namespace Database\Factories;

use Domains\Profile\Enums\ProfileTypes;
use Domains\Profile\Models\Profile;
use Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid,
            'user_id' => User::factory(),
            'profile_type' => ProfileTypes::PERSONAL->value,
            'details' => [
                'first_name' => 'Raven',
                'last_name' => 'Paragas',
            ],
        ];
    }
}
