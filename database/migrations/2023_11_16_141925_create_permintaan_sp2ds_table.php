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
        Schema::create('permintaan_sp2ds', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('pesan')->nullable();
            $table->string('tanggal')->nullable();
            $table->enum('status', ['tolak', 'menunggu', 'proses', 'selesai'])->default('menunggu');
            $table->foreignId('sp2d_id')->nullable()->constrained('sp2ds')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_sp2ds');
    }
};
