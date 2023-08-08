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
        Schema::create('beer_rating_totals', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('beer_id');
            $table->float('average_rating');
            $table->integer('total_rater');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beer_rating_totals');
    }
};
