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
        Schema::create('beer_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('locale', config('app.available_locales'));
            $table->text('description');
            $table->foreignUuid('beer_id');
            $table->boolean('is_default_locale');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beer_translations');
    }
};
