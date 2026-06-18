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
        Schema::create('album_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')
                ->constrained('albums')
                ->cascadeOnDelete();
            $table->string('name', 100)->comment('Nama varian (Photobook, Digipack, dll)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_variants');
    }
};
