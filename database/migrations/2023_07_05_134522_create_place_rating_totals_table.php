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
        Schema::create('place_rating_totals', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('place_id');
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
        Schema::dropIfExists('place_rating_totals');
    }
};
