<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('latihan_soal', function (Blueprint $table) {
            $table->id();
            $table->string('bab');
            $table->string('nama');
            $table->string('keterangan');
            $table->longText('detail');
            $table->timestamp('tenggat');
            $table->string('ubah')->default('ya');
            $table->unsignedBigInteger('guru_id');
            $table->foreign('guru_id')->references('id')->on('guru')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('latihan_soal');
    }
};
