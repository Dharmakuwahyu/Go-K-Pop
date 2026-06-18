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
        Schema::create('store_settings', function (Blueprint $table) {
            // id selalu 1 — hanya ada 1 baris (singleton pattern)
            $table->tinyInteger('id')->unsigned()->primary()->default(1);
            $table->string('bank_name', 50)->comment('Nama bank (BRI, BCA, dll)');
            $table->string('account_number', 30)->comment('Nomor rekening');
            $table->string('account_holder', 100)->comment('Atas nama rekening');
            $table->string('whatsapp_number', 20)->nullable()->comment('Nomor WA admin');
            $table->decimal('dp1_percent', 5, 2)->default(35.00)->comment('Persentase DP1 default');
            // $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_settings');
    }
};
