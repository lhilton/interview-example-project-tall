<?php

use App\Models\Tag;
use App\Models\User;
use App\Models\Website;

beforeEach(function () {
    $this->user = User::factory()->create();
    auth()->login($this->user);
    expect(auth()->user())->toBe($this->user);
});

it('attaches tags to a website', function () {
    $tags = Tag::factory()->count(42)->create();
    $website = Website::factory()
        ->for($this->user)
        ->create();
    $website->tags()->attach($tags);
    expect($website->tags()->count())->toBe(42);
});

it('can be seen via relationship on website model', function () {
    $tag = Tag::factory()->create();
    $website = Website::factory()
        ->for($this->user)
        ->create();
    $website->tags()->attach($tag);

    expect($website->tags()->first()->id)->toBe($tag->id);
});

it('can see website model via relationship', function () {
    $tag = Tag::factory()->create();
    $website = Website::factory()
        ->for($this->user)
        ->create();
    $website->tags()->attach($tag);

    expect($tag->websites()->first()->id)->toBe($website->id);
});
