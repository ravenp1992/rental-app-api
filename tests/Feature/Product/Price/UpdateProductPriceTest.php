<?php

use Domains\Product\Models\Price;
use Domains\Product\Models\Product;
use Domains\User\Models\User;

use function Pest\Laravel\putJson;

describe('Update Product Price', function () {
    beforeEach(function () {
        $user = User::factory()->create();

        $this->actingAs($user);
    });

    it('should should return 422 if productId is missing', function () {
        $product = Product::factory()->create();
        $price = Price::factory([
            'product_id' => $product->id,
        ])->create();

        putJson(route('prices.update', [
            'product' => $product->uuid, 'price' => $price->uuid,
        ]), [
            //
        ])->assertInvalid(['productId']);
    });

    it('should update a product', function () {
        $product = Product::factory()->create();
        $price = Price::factory([
            'product_id' => $product->id,
        ])->create();

        putJson(route('prices.update', [
            'price' => $price->uuid,
        ]), [
            'productId' => $product->uuid,
            'dailyRate' => 50,
            'weeklyRate' => 350,
            'monthlyRate' => 1400,
            'buyPrice' => 4000,
            'currency' => 'PHP',
            'validFrom' => '2024-09-28',
            'validTo' => '2024-09-30',
        ])->assertNoContent();

        $price = Price::where('uuid', $price->uuid)->first();

        expect($price)
            ->daily_rate->toBe(50)
            ->weekly_rate->toBe(350)
            ->monthly_rate->toBe(1400)
            ->buy_price->toBe(4000)
            ->currency->toBe('PHP')
            ->valid_from->toBe('2024-09-28')
            ->valid_to->toBe('2024-09-30');
    });
});
