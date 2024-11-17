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
        Schema::create('position_comforts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('position_id')
                ->references('id')
                ->on('positions')
                ->cascadeOnDelete();

            $table->foreignId('comfort_level_id')
                ->references('id')
                ->on('comfort_levels')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('position_comforts');
    }
};
