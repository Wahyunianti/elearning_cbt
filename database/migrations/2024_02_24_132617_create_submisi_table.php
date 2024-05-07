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
        Schema::create('submisi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('latihan_soal_id');
            $table->foreign('latihan_soal_id')->references('id')->on('latihan_soal')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('users_id');
            $table->string('lampiran');
            $table->string('nilai')->default('belum dinilai');
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
        Schema::dropIfExists('submisi');
    }
};
