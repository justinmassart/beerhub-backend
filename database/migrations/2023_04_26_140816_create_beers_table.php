<?php

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
        Schema::create('beers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->enum('type', ['Blond', 'Amber', 'Black', 'Brown', 'White', 'Fruity', 'IPA', 'Stout']);
            $table->string('country');
            $table->json('volume_available');
            $table->json('container_available');
            $table->json('aromas');
            $table->json('ingredients');
            $table->enum('color', ['White', 'Black', 'Brown', 'Amber', 'Red', 'Blond', 'Blue']);
            $table->float('abv');
            $table->float('ibu');
            $table->boolean('is_from_abbey');
            $table->timestamps();
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
