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
            // $table->char('album_id', 36);
            $table->foreignId('album_id')
                ->constrained('albums')
                ->restrictOnDelete();
            $table->string('title', 100)->comment('Nama sesi sortir');
            $table->enum('status', ['open', 'processing', 'closed'])->default('open');
            // $table->char('created_by', 36)->comment('Admin pembuat');
            // dibuat null karena belum ada profile
            $table->foreignId('created_by')
                ->nullable()
                ->comment('Admin pembuat')
                ->constrained('profiles')
                ->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();

            // $table->foreign('album_id')
            //     ->references('id')
            //     ->on('albums')
            //     ->onDelete('restrict');

            // $table->foreign('created_by')
            //     ->references('id')
            //     ->on('profiles')
            //     ->onDelete('restrict');
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
