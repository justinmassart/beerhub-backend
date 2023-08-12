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
        Schema::create('brands', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique()->index();
            $table->string('slogan')->nullable();
            $table->string('address')->unique();
            $table->float('latitude');
            $table->float('longitude');
            $table->integer('creation_date');
            $table->string('country');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
