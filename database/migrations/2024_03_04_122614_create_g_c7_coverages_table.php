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
        Schema::create('g_c7_coverages', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('county');
            $table->string('dhts')->nullable();
            $table->string('tcs')->nullable();
            $table->string('pmtct')->nullable();
            $table->string('ayp')->nullable();
            $table->string('msm')->nullable();
            $table->string('fsw')->nullable();
            $table->string('tg')->nullable();
            $table->string('pwid')->nullable();
            $table->string('hrg')->nullable();
            $table->string('ff')->nullable();
            $table->string('truckers')->nullable();
            $table->string('dc')->nullable();
            $table->string('prison')->nullable();
            $table->string('total_program')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g_c7_coverages');
    }
};
