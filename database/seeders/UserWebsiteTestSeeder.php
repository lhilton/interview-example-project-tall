<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserWebsiteTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Adding a transaction here out of habit. I have been burnt just often enough by
        // using a seeder in production and having a failure result in partial completion
        // leaving the data in questionable state.
        DB::transaction(function () {
            $websites = Website::factory()
                ->for(User::factory())
                ->count(10)
                ->create();

            $websites->each(function (Website $website) {
                $website->tags()->attach(Tag::inRandomOrder()->limit(rand(1, 4))->get());
            });
        });
    }
}
