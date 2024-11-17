<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_unavailable_days', function (Blueprint $table) {
            $table->id();
            $table->datetime('start');
            $table->datetime('end');

            $table->foreignId('car_id')
                ->references('id')
                ->on('cars');

            $table->foreignId('user_id')
                ->references('id')
                ->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_unavailable_days');
    }
};
