<?php

namespace Database\Factories;

use Carbon\Carbon;
use Domains\Product\Models\Price;
use Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceFactory extends Factory
{
    protected $model = Price::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dailyRate = rand(1, 10) * 24;
        $weeklyRate = rand(1, 10) * 24 * 7;
        $monthlyRate = rand(1, 10) * 24 * 7 * Carbon::now()->daysInMonth();
        $buyPrice = rand(500, 3000);
        $validFrom = Carbon::now();
        $validTo = Carbon::now()->addDays(rand(1, 5));

        return [
            'uuid' => $this->faker->uuid,
            'product_id' => Product::factory(),
            'daily_rate' => $dailyRate,
            'weekly_rate' => $weeklyRate,
            'monthly_rate' => $monthlyRate,
            'buy_price' => $buyPrice,
            'currency' => $this->faker->randomElement(['USD', 'PHP']),
            'valid_from' => $validFrom->format('Y-m-d'),
            'valid_to' => $validTo->format('Y-m-d'),
        ];
    }
}
