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
        Schema::create('order_priorities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();
            $table->tinyInteger('priority')->comment('Angka 1, 2, atau 3');
            $table->string('member_name', 100)->comment('Nama member pilihan');

            // Satu pesanan tidak boleh punya dua prioritas yang sama
            $table->unique(['order_id', 'priority']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_priorities');
    }
};
