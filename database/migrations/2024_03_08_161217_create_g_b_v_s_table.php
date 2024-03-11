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
        Schema::create('g_b_v_s', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('sno');
            $table->string('year');
            $table->string('quater')->nullable();
            $table->string('region');
            $table->string('sr_name');
            $table->string('county');
            $table->string('subcounty');
            $table->string('ward')->nullable();
            $table->string('village')->nullable();
            $table->string('report_month')->nullable();
            $table->string('paralegal')->nullable();
            $table->string('bname')->nullable();
            $table->string('dob')->nullable();
            $table->string('age')->nullable();
            $table->string('sex')->nullable();
            $table->string('typology')->nullable();
            $table->string('disability')->nullable();
            $table->string('disability_type')->nullable();
            $table->string('phone')->nullable();
            $table->string('confidant_no')->nullable();
            $table->string('abuse')->nullable();
            $table->string('perpetrator')->nullable();
            $table->string('legal_clinic')->nullable();
            $table->string('litigation')->nullable();
            $table->string('legal_counsel')->nullable();
            $table->string('referral')->nullable();
            $table->string('care_status')->nullable();
            $table->string('comment')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g_b_v_s');
    }
};
