<?php

use Domains\User\Models\User;

use function Pest\Laravel\postJson;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

it('should return 422 if name is missing', function () {
    postJson(route('priceplans.store'), [
        'description' => 'Hourly Price',
    ])->assertInvalid(['name']);
});

it('should return 422 if description is missing', function () {
    postJson(route('priceplans.store'), [
        'name' => 'Hourly Price',
    ])->assertInvalid(['description']);
});

it('should create a price plan', function () {
    $pricePlan = postJson(route('priceplans.store'), [
        'name' => 'Hourly Price',
        'description' => 'Hourly Price Description',
    ])
        ->json('data');

    expect($pricePlan)
        ->attributes->name->toBe('Hourly Price')
        ->attributes->description->toBe('Hourly Price Description');
});
