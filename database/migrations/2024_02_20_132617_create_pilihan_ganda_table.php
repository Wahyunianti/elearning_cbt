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
        Schema::create('pilihan_ganda', function (Blueprint $table) {
            $table->id();
            $table->longText('question');
            $table->text('options');
            $table->string('foto')->nullable();
            $table->string('correct_option');
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
        Schema::dropIfExists('pilihan_ganda');
    }
};
