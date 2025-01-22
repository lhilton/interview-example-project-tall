<?php

use App\Livewire\Websites\View;
use App\Models\User;
use App\Models\Website;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
    auth()->login($this->user);
    expect(auth()->user())->toBe($this->user);

    $this->website = Website::factory()->for($this->user)->create();
});

test('user can edit website name', function () {
    Livewire::test(View::class, ['website' => $this->website])
        ->assertStatus(200)
        ->assertViewHas('name', $this->website->name)
        ->set('name', 'Test Name')
        ->call('save');

    expect($this->website->name)->not()->toBe('Test Name');

    $this->website->refresh();

    expect($this->website->name)->toBe('Test Name');
});
