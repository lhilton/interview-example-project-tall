<?php

use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
        });

        // Culturally, I'm not a fan of putting DML statements in a migration. I prefer to use a seed file for this,
        // then call that seed file here instead of directly adding the data here. This is not universal, so I am
        // inlining this in order to save time.

        // An important note about Static Analysis: This file will not be checked. I kept the STAN configuration as
        // vanilla, however in a production project I would add the appropriate paths to include the ./database folder.

        Tag::insert([
            ['name' => 'Landing page'],
            ['name' => 'Forum'],
            ['name' => 'Ecommerce'],
            ['name' => 'Blog'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
