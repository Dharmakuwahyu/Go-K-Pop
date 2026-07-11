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
        // dicek lagi untuk migrasinya
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code', 20)->unique()->comment('Kode readable, contoh: ORD-001');
            $table->foreignId('user_id')
                ->comment('Pembeli')
                ->constrained('profiles')
                ->restrictOnDelete();
            $table->foreignId('album_id')
                ->constrained('albums')
                ->restrictOnDelete();
            $table->foreignId('variant_id')
                ->constrained('album_variants')
                ->restrictOnDelete();
            $table->integer('qty')->default(1)->comment('Jumlah album dipesan');
            $table->integer('price_per_album')->comment('Harga satuan saat pesan');
            $table->string('buyer_name', 100)->comment('Nama pembeli (denormalized)');
            $table->string('buyer_city', 50)->nullable();
            $table->enum('status', [
                'pending_dp1',
                'dp1_confirmed',
                'pending_dp2',
                'dp2_confirmed',
                'pending_pelunasan',
                'pelunasan_confirmed',
                'shipped',
            ])->default('pending_dp1');
            $table->string('cargo_status', 50)->nullable()->comment('Status kargo (Di Gudang Korea, OTW Indo, dll)');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
