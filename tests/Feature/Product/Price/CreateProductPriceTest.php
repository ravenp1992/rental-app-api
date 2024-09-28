<?php

use Domains\Product\Models\Product;
use Domains\User\Models\User;
use Illuminate\Http\Response;

use function Pest\Laravel\postJson;

beforeEach(function () {
    $user = User::factory()->create();

    $this->actingAs($user);
});

describe('Create Product Price', function () {

    it('should return 422 if productId is missing', function () {
        $product = Product::factory()->create();

        $price = postJson(route('prices.store', compact('product')), [])
            ->assertInvalid(['productId']);
    });

    it('should return 422 if dailyRate is', function (int|string $dailyRate) {
        $product = Product::factory()->create();

        $price = postJson(route('prices.store', compact('product')), [
            'productId' => $product->uuid,
            'dailyRate' => $dailyRate,
        ])
            ->assertInvalid(['dailyRate']);
    })->with([
        'hello',
        'ab1',
        '',
        0,
    ]);

    it('should return 422 if weeklyRate is', function (int|string $weeklyRate) {
        $product = Product::factory()->create();

        $price = postJson(route('prices.store', compact('product')), [
            'productId' => $product->uuid,
            'weeklyRate' => $weeklyRate,
        ])
            ->assertInvalid(['weeklyRate']);
    })->with([
        'hello',
        'ab1',
        '',
        0,
    ]);

    it('should return 422 if monthlyRate is', function (int|string $monthlyRate) {
        $product = Product::factory()->create();

        $price = postJson(route('prices.store', compact('product')), [
            'productId' => $product->uuid,
            'monthlyRate' => $monthlyRate,
        ])
            ->assertInvalid(['monthlyRate']);
    })->with([
        'hello',
        'ab1',
        '',
        0,
    ]);

    it('should return 422 if currency is', function (int $dailyRate, int $weeklyRate, int $monthlyRate, ?string $currency) {
        $product = Product::factory()->create();

        $price = postJson(route('prices.store', compact('product')), [
            'productId' => $product->uuid,
            'dailyRate' => $dailyRate,
            'weeklyRate' => $weeklyRate,
            'monthlyRate' => $monthlyRate,
            'currency' => $currency,
        ])->assertInvalid(['currency']);

    })->with([
        ['dailyRate' => 5, 'weeklyRate' => 10, 'monthlyRate' => 25, 'currency' => null],
        ['dailyRate' => 5, 'weeklyRate' => 10, 'monthlyRate' => 25, 'currency' => ''],
        ['dailyRate' => 5, 'weeklyRate' => 10, 'monthlyRate' => 25, 'currency' => 'asdf'],
    ]);

    it('should return 422 if validFrom is', function (?string $validFrom, ?string $validTo) {
        $product = Product::factory()->create();

        $price = postJson(route('prices.store', compact('product')), [
            'productId' => $product->uuid,
            'dailyRate' => 15,
            'weeklyRate' => 25,
            'monthlyRate' => 35,
            'currency' => 'USD',
            'validFrom' => $validFrom,
            'validTo' => $validTo,
        ])->assertInvalid(['validFrom']);

    })->with([
        ['validFrom' => null, 'validTo' => '2024-09-28'],
        ['validFrom' => '', 'validTo' => '2024-09-28'],
        ['validFrom' => '2024-09-30', 'validTo' => '2024-09-28'],
    ]);

    it('should return 422 if validTo is', function (?string $validFrom, ?string $validTo) {
        $product = Product::factory()->create();

        $price = postJson(route('prices.store', compact('product')), [
            'productId' => $product->uuid,
            'dailyRate' => 15,
            'weeklyRate' => 25,
            'monthlyRate' => 35,
            'currency' => 'USD',
            'validFrom' => $validFrom,
            'validTo' => $validTo,
        ])->assertInvalid(['validTo']);

    })->with([
        ['validFrom' => '2024-09-28', 'validTo' => null],
        ['validFrom' => '2024-09-29', 'validTo' => ''],
    ]);

    it('should create a product', function () {
        $product = Product::factory()->create();

        $price = postJson(route('prices.store', ['product' => $product->uuid]), [
            'productId' => $product->uuid,
            'dailyRate' => 15,
            'weeklyRate' => 25,
            'monthlyRate' => 35,
            'currency' => 'USD',
            'validFrom' => '2024-09-28',
            'validTo' => '2024-09-30',
        ])
            ->assertStatus(Response::HTTP_CREATED)
            ->json('data');

        expect($price)
            ->attributes->dailyRate->toBe(15)
            ->attributes->weeklyRate->toBe(25)
            ->attributes->monthlyRate->toBe(35)
            ->attributes->currency->toBe('USD')
            ->attributes->validFrom->toBe('2024-09-28')
            ->attributes->validTo->toBe('2024-09-30');
    });
});
