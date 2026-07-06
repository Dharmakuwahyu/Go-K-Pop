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
        Schema::create('sorting_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')
                ->constrained('albums')
                ->restrictOnDelete();
            $table->string('title', 100)->comment('Nama sesi sortir');
            $table->enum('status', ['open', 'processing', 'closed'])->default('open');
            // dibuat null karena belum ada profile
            $table->foreignId('created_by')
                ->comment('Admin pembuat')
                ->constrained('profiles')
                ->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorting_sessions');
    }
};
