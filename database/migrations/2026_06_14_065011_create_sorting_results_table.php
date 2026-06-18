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
        Schema::create('sorting_results', function (Blueprint $table) {
            $table->id();
            // $table->char('session_id', 36);
            $table->foreignId('session_id')
                ->constrained('sorting_sessions')
                ->cascadeOnDelete();
            // $table->char('order_id', 36);
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();
            $table->string('assigned_member', 100)->comment('Member yang didapat dari sortir');
            $table->timestamp('created_at')->useCurrent();

            // $table->foreign('session_id')
            //     ->references('id')
            //     ->on('sorting_sessions')
            //     ->onDelete('cascade');

            // $table->foreign('order_id')
            //     ->references('id')
            //     ->on('orders')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorting_results');
    }
};
