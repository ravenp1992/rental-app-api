<?php

use Domains\Product\Models\PricePlan;
use Domains\User\Models\User;

use function Pest\Laravel\getJson;

it('should return all price plans', function () {
    PricePlan::factory()->count(5)->create();

    $pricePlans = getJson(route('priceplans.index'))
        ->json('data');

    expect($pricePlans)->toHaveCount(5);
});

it('should return a single price plan', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    PricePlan::factory()->count(5)->create();

    $hourly = PricePlan::factory([
        'name' => 'Hourly',
    ])->create();

    $pricePlan = getJson(route('priceplans.show', ['priceplan' => $hourly]))
        ->json('data');

    expect($pricePlan)
        ->attributes->name->toBe('Hourly');
});
