<?php

use Domains\Product\Models\PricePlan;
use Domains\User\Models\User;

use function Pest\Laravel\putJson;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

it('should update price plan', function (string $name) {
    $priceplan = PricePlan::factory([
        'name' => 'Hourly',
        'description' => 'Hourly Desc',
    ])->create();

    putJson(route('priceplans.update', compact('priceplan')), [
        'name' => $name,
        'description' => 'Hourly Desc Updated',
    ])
        ->assertNoContent();
})->with([
    'Hourly',
    'Hourly Updated',
]);
