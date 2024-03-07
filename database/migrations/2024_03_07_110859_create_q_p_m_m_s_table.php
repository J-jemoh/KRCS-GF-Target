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
        Schema::create('q_p_m_m_s', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('sno');
            $table->string('region');
            $table->string('target_group');
            $table->text('indicators');
            $table->string('pt_quater_1')->nullable();
            $table->string('pt_quater_2')->nullable();
            $table->string('pt_quater_3')->nullable();
            $table->string('pt_quater_4')->nullable();
            $table->string('pt_quater_5')->nullable();
            $table->string('pt_quater_6')->nullable();
            $table->string('pt_quater_7')->nullable();
            $table->string('pt_quater_8')->nullable();
            $table->string('pt_quater_9')->nullable();
            $table->string('pt_quater_10')->nullable();
            $table->string('pt_quater_11')->nullable();
            $table->string('pt_quater_12')->nullable();
            $table->string('pt_total')->nullable();
            $table->string('pa_quater1')->nullable();
            $table->string('pa_quater2')->nullable();
            $table->string('pa_quater3')->nullable();
            $table->string('pa_quater4')->nullable();
            $table->string('pa_quater5')->nullable();
            $table->string('pa_quater6')->nullable();
            $table->string('pa_quater7')->nullable();
            $table->string('pa_quater8')->nullable();
            $table->string('pa_quater9')->nullable();
            $table->string('pa_quater10')->nullable();
            $table->string('pa_quater11')->nullable();
            $table->string('pa_quater12')->nullable();
            $table->string('pa_total')->nullable();
            $table->string('percent')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('q_p_m_m_s');
    }
};
