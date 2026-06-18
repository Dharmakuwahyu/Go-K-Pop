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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            // $table->char('order_id', 36)->unique()->comment('Satu pesanan = satu pengiriman');
            $table->foreignId('order_id')
                ->unique()
                ->comment('Satu pesanan = satu pengiriman')
                ->constrained('orders')
                ->cascadeOnDelete();
            $table->text('address')->comment('Alamat lengkap pengiriman');
            $table->string('courier', 20)->comment('Nama kurir (J&T, JNE, SiCepat)');
            $table->string('tracking_number', 50)->nullable()->comment('Nomor resi');
            $table->integer('shipping_cost')->default(0)->comment('Ongkir');
            $table->timestamp('shipped_at')->nullable()->comment('Waktu dikirim');

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
        Schema::dropIfExists('shipments');
    }
};
