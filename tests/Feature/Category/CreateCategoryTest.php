<?php

use Domains\Category\Enums\CategoryStatus;
use Domains\User\Models\User;
use Illuminate\Http\Response;

use function Pest\Laravel\postJson;

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

describe('Create Category', function () {
    it('should return a 422 if name is missing', function () {
        postJson(route('categories.store'), [
            'name' => null,
        ])->assertInvalid(['name']);
    });

    it('should return a 422 if status is invalid', function () {
        postJson(route('categories.store', [
            'name' => 'hello world',
            'status' => 'test',
        ]))->assertInvalid(['status']);
    });

    it('shoud create a category', function () {
        $category = postJson(route('categories.store', [
            'name' => 'hello world',
            'status' => CategoryStatus::ACTIVE->value,
        ]))
            ->assertStatus(Response::HTTP_CREATED)
            ->json('data');

        expect($category)
            ->attributes->name->toBe('hello world')
            ->attributes->slug->toBe('hello-world')
            ->attributes->status->toBe('active');
    });
});
