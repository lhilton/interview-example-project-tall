<?php

use App\Models\User;
use App\Models\Website;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    $this->user = User::factory()->create();
    auth()->login($this->user);
    expect(auth()->user())->toBe($this->user);
});

it('creates a website for authenticated user', function () {
    $website = Website::factory()
        ->for($this->user)
        ->create();

    expect($website)->toBeInstanceOf(Website::class);
    assertDatabaseHas('websites', ['id' => $website->id, 'user_id' => $this->user->id]);
});

it('can see the owning user via relationship', function () {
    $website = Website::factory()
        ->for($this->user)
        ->create();

    $user = $website->user;

    expect($user->id)->toBe(auth()->id());
});

it('can be seen by the owning user', function () {
    $website = Website::factory()
        ->for($this->user)
        ->create();

    expect($this->user->websites()->first()->id)->toBe($website->id);
});

it('can run the test seeder requested in github issue #3', function () {
    $this->seed(\Database\Seeders\UserWebsiteTestSeeder::class);
    assertDatabaseCount('websites', 10);
    Website::all()->each(function (Website $website) {
        expect($website->tags()->count())->toBeGreaterThan(0);
    });
});
