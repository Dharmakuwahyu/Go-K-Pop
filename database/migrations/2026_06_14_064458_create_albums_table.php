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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('group_name', 100)->comment('Nama grup K-Pop');
            $table->string('title', 150)->comment('Judul album');
            $table->integer('price')->comment('Harga dalam Rupiah');
            $table->integer('total_slots')->comment('Total slot tersedia');
            $table->integer('slots_left')->comment('Sisa slot yang masih bisa dipesan');
            $table->string('image_url', 500)->nullable()->comment('Link foto cover album');
            $table->enum('status', ['aktif', 'tutup'])->default('aktif');
            $table->foreignId('created_by')
                ->constrained('profiles')
                ->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
