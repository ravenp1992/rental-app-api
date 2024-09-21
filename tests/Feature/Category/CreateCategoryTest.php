<?php

use Domains\User\Models\User;
use Illuminate\Http\Response;

use function Pest\Laravel\postJson;

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

it('should return a 422 if name is missing', function () {
    postJson(route('categories.store'), [
        'name' => null,
    ])->assertInvalid(['name']);
});

it('should return a 422 if isActive is not true or false', function () {
    postJson(route('categories.store', [
        'name' => 'hello world',
        'isActive' => 'test',
    ]))->assertInvalid(['isActive']);
});

it('shoud create a category', function () {
    $category = postJson(route('categories.store', [
        'name' => 'hello world',
        'isActive' => 1,
    ]))
        ->assertStatus(Response::HTTP_CREATED)
        ->json('data');

    expect($category)
        ->attributes->name->toBe('hello world')
        ->attributes->slug->toBe('hello-world')
        ->attributes->isActive->toBe(1);
});
