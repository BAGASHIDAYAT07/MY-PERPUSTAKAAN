<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('peminjaman')) {
            Schema::create('peminjaman', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('buku_id')->constrained()->onDelete('cascade');
                $table->date('tanggal_pinjam');
                $table->date('tanggal_kembali')->nullable();
                $table->string('status')->default('dipinjam');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
