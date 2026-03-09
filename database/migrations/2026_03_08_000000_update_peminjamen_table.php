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
        Schema::table('peminjamen', function (Blueprint $table) {
            // Tambah kolom untuk tanggal pengembalian aktual
            $table->date('tanggal_pengembalian_aktual')->nullable()->after('tanggal_pengembalian');
            // Tambah kolom untuk denda
            $table->decimal('denda', 10, 2)->default(0)->after('tanggal_pengembalian_aktual');
            // Tambah kolom untuk keterangan
            $table->text('keterangan')->nullable()->after('denda');
            // Tambah kolom untuk admin yang approve
            $table->unsignedBigInteger('approved_by')->nullable()->after('keterangan');
            $table->foreign('approved_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn(['tanggal_pengembalian_aktual', 'denda', 'keterangan', 'approved_by']);
        });
    }
};
