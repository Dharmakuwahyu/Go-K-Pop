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
        Schema::create('wishlists', function (Blueprint $table) {
            // Primary key gabungan: satu user tidak bisa wishlist album yang sama dua kali
            // $table->char('user_id', 36);
            // $table->char('album_id', 36);
            $table->foreignId('user_id')->constrained('profiles')->cascadeOnDelete();
            $table->foreignId('album_id')->constrained('albums')->cascadeOnDelete();
            $table->foreignId('user_id');
            $table->foreignId('album_id');
            $table->timestamp('created_at')->useCurrent();

            $table->primary(['user_id', 'album_id']);

            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('profiles')
            //     ->onDelete('cascade');

            // $table->foreign('album_id')
            //     ->references('id')
            //     ->on('albums')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
