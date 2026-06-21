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
            // $table->char('user_id', 36)->comment('Pembeli');
            // $table->char('album_id', 36);
            // $table->char('variant_id', 36);
            $table->foreignId('user_id')
            // sementara dibuat null karena belum ada data di tabel profiles
                ->nullable()
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

            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('profiles')
            //     ->onDelete('restrict');

            // $table->foreign('album_id')
            //     ->references('id')
            //     ->on('albums')
            //     ->onDelete('restrict');

            // $table->foreign('variant_id')
            //     ->references('id')
            //     ->on('album_variants')
            //     ->onDelete('restrict');
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
