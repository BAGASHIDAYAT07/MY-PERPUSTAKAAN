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
      Schema::create('Bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('JenisBuku');
            $table->string('Penerbit');
            $table->string('Pencipta');
            $table->string('TempatTerbit');
            $table->dateTime('TahunTerbit')->format('Y-m-d');
            $table->integer('JumlahHalaman');
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
