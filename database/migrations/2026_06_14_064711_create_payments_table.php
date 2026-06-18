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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_code', 20)->unique()->comment('Kode readable, contoh: PAY-001');
            // $table->char('order_id', 36);
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();
            $table->enum('phase', ['DP 1', 'DP 2', 'Pelunasan'])->comment('Tahap pembayaran');
            $table->integer('amount')->comment('Nominal transfer');
            $table->string('proof_image_url', 500)->nullable()->comment('Link foto bukti transfer');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->string('reject_reason', 255)->nullable()->comment('Alasan ditolak');
            // $table->char('verified_by', 36)->nullable()->comment('Admin yang memverifikasi');
            $table->foreignId('verified_by')
                ->nullable()
                ->comment('Admin yang memverifikasi')
                ->constrained('profiles')
                ->nullOnDelete();
            $table->timestamp('uploaded_at')->useCurrent()->comment('Waktu upload bukti');
            $table->timestamp('verified_at')->nullable()->comment('Waktu diverifikasi');

            // $table->foreign('order_id')
            //     ->references('id')
            //     ->on('orders')
            //     ->onDelete('cascade');

            // $table->foreign('verified_by')
            //     ->references('id')
            //     ->on('profiles')
            //     ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
