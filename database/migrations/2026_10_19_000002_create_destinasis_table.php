<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('destinasis', function (Blueprint $table) {
            // primary key
            $table->id('id_destinasi');
            // foreign key ke tabel kategoris
            $table->foreignId('id_kategori');
            $table->string('nama');
            $table->string('slug')->unique();
            $table->unsignedInteger('harga_dewasa');
            $table->unsignedInteger('harga_anak');
            $table->unsignedInteger('kuota')->default(500);
            $table->unsignedTinyInteger('rating')->default(5);
            $table->string('lokasi', 100);
            $table->string('jam_buka', 100)->nullable();
            $table->string('durasi', 50)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto', 150);
            // Y = aktif (tampil di website), N = non-aktif
            $table->char('status', 1)->default('Y');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('destinasis');
    }
};
