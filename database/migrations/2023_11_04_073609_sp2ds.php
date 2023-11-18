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
        Schema::create('sp2ds', function (Blueprint $table) {
            $table->id();
            $table->string('no_spm');
            $table->date('tgl_sp2d')->nullable();

            $table->string('no_surat')->unique()->nullable();
            $table->string('no_rek_keuangan')->nullable();
            $table->string('bank_pos_keuangan')->nullable();
            $table->string('tahun_anggaran');
            $table->string('bank_pos');
            $table->string('rekening');
            $table->unsignedBigInteger('jumlah_uang');
            $table->string('kepada');
            $table->string('npwp');
            $table->string('keperluan');
            $table->boolean('is_delete')->default(false);
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnUpdate();
            $table->foreignId('ttd_id')->nullable()->constrained('ttds')->cascadeOnUpdate();
            $table->foreignId('skpd_id')->nullable()->constrained('skpds')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
