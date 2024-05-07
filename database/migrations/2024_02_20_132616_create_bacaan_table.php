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
        Schema::create('bacaan', function (Blueprint $table) {
            $table->id();
            $table->longText('soal');
            $table->string('foto')->nullable();
            $table->string('jawaban');
            $table->unsignedBigInteger('kuis_id');
            $table->foreign('kuis_id')->references('id')->on('kuis')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('bacaan');
    }
};
