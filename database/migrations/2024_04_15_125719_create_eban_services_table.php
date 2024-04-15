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
        Schema::create('eban_services', function (Blueprint $table) {
            $table->id();
            $table->string('unique_identifier')->unique();
            $table->integer('user_id');
            $table->string('sno');
            $table->string('month');
            $table->integer('year');
            $table->string('region');
            $table->string('counties');
            $table->text('couple_code');
            $table->string('s1')->nullable();
            $table->string('s2')->nullable();
            $table->string('s3')->nullable();
            $table->string('s4')->nullable();
            $table->string('s5')->nullable();
            $table->string('s6')->nullable();
            $table->string('s7')->nullable();
            $table->string('s8')->nullable();
            $table->string('make_up_sessions')->nullable();
            $table->string('complete_session')->nullable();
            $table->text('provide_with_condom')->nullable();
            $table->string('prep_r')->nullable();
            $table->text('prep_c')->nullable();
            $table->text('pep_r')->nullable();
            $table->string('pep_c')->nullable();
            $table->text('pss_r')->nullable();
            $table->text('pss_c')->nullable();
            $table->string('hts_r')->nullable();
            $table->string('hts_c')->nullable();
            $table->string('fp_r')->nullable();
            $table->string('fp_c')->nullable();
            $table->string('gbv_r')->nullable();
            $table->text('gbv_c')->nullable();
            $table->string('sti_r')->nullable();
            $table->text('sti_c')->nullable();
            $table->string('vmmc_r')->nullable();
            $table->string('vmmc_c')->nullable();
            $table->text('audit_r')->nullable();
            $table->string('audit_c')->nullable();
            $table->text('care_r')->nullable();
            $table->string('care_c')->nullable();
            $table->string('cervical_cancer_s_r')->nullable();
            $table->text('cervical_cancer_c')->nullable();
            $table->string('pmtct_r')->nullable();
            $table->text('pmtct_c')->nullable();
            $table->string('other_r')->nullable();
            $table->string('other_c')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eban_services');
    }
};
