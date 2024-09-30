<?php

use Domains\Category\Models\Category;
use Domains\User\Models\User;

use function Pest\Laravel\putJson;

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

it('it should return an updated category', function (string $name, string $status) {
    $category = Category::factory([
        'name' => 'tools',
    ])->create();

    putJson(route('categories.update', compact('category')), [
        'name' => $name,
        'status' => $status,
    ])
        ->assertNoContent();

    expect(Category::find($category->id))
        ->name->toBe($name)
        ->status->toBe($status);
})->with([
    ['name' => 'tools', 'status' => 'active'],
    ['name' => 'tools updated', 'status' => 'inactive'],
]);
