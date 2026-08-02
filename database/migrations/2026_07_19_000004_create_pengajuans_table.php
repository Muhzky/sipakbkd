<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained()->onDelete('cascade');
            $table->string('nomor_pengajuan')->unique();
            $table->date('tanggal');
            $table->string('pangkat_lama');
            $table->string('pangkat_baru');
            $table->string('jenis_kenaikan');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['menunggu', 'dokumen_tidak_lengkap', 'menunggu_verifikasi', 'ditolak_operator', 'terverifikasi', 'disetujui', 'ditolak'])->default('menunggu');
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
