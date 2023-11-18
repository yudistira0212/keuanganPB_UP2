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
        Schema::create('spm_arsips', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('path');
            $table->string('nomor_arsip')->unique();
            $table->date('tanggal');
            $table->enum('jenis', ['GU', 'TU', 'UP', 'LS']);
            $table->string('keterangan');
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spm_arsips');
    }
};
