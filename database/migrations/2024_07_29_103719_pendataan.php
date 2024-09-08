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
        Schema::create('tb_pendataan', function (Blueprint $table) {
            $table->id();
            $table->string("no_pendataan");
            $table->bigInteger("nik");
            $table->string("nama_lengkap");
            $table->string("jenis_kelamin");
            $table->integer("umur");
            $table->string("alamat");
            $table->string("status");
            $table->string("provinsi")->nullable();
            $table->string("kabupaten-kota")->nullable();
            $table->string("kecamatan")->nullable();
            $table->string("kelurahan-desa")->nullable();
            $table->string("penghasilan")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pendataan');
    }
};
