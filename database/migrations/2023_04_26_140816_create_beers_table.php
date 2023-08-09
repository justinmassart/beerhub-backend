<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('beers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->enum('type', ['Blond', 'Amber', 'Black', 'Brown', 'White', 'Fruity', 'IPA', 'Stout']);
            $table->string('country');
            $table->json('volume_available')->nullable();
            $table->json('container_available')->nullable();
            $table->json('aromas')->nullable();
            $table->json('ingredients')->nullable();
            $table->enum('color', ['White', 'Black', 'Brown', 'Amber', 'Red', 'Blond', 'Blue']);
            $table->float('abv');
            $table->float('ibu')->nullable();
            $table->boolean('is_gluten_free')->nullable();
            $table->boolean('is_from_abbey')->nullable();
            $table->boolean('non_filtered')->nullable();
            $table->boolean('refermented')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('created_at', 'name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beers');
    }
};
