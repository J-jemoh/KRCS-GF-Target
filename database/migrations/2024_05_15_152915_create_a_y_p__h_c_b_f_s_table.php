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
        Schema::create('a_y_p__h_c_b_f_s', function (Blueprint $table) {
            $table->id();
            $table->integer('sno');
            $table->integer('user_id');
            $table->string('unique_identifier')->unique();
            $table->enum('month',['Jan','Feb','March','April','May','June','July','August','Sept','Oct','Nov','Dec']);
            $table->integer('year');
            $table->string('region');
            $table->string('county');
            $table->string('sub_county');
            $table->string('ward');
            $table->text('venue');
            $table->string('implementing_partner');
            $table->text('facilitator_1');
            $table->string('facilitator_2');
            $table->text('start_date');
            $table->text('end_date');
            $table->string('name');
            $table->integer('age');
            $table->enum('sex',['F','M']);
            $table->enum('session1',['Done','Not Done']);
            $table->enum('session2',['Done','Not Done']);
            $table->enum('session3',['Done','Not Done']);
            $table->enum('session4',['Done','Not Done']);
            $table->enum('ssssion5',['Done','Not Done']);
            $table->enum('session6',['Done','Not Done']);
            $table->enum('session7',['Done','Not Done']);
            $table->enum('make_up_session_date',['Done','Not Done']);
            $table->enum('complete_sessions',['Complete Sessions','Not Complete']);
            $table->enum('provided_condoms',['Yes','No']);
            $table->enum('risk_assessment_r',['Done','Not Done']);
            $table->enum('risk_assessment_c',['Done','Not Done']);
            $table->enum('vmmc_r',['Done','Not Done']);
            $table->enum('vmmc_c',['Done','Not Done']);
            $table->enum('ovc_r',['Done','Not Done']);
            $table->enum('ovc_c',['Done','Not Done']);
            $table->enum('prc_r',['Done','Not Done']);
            $table->enum('prc_c',['Done','Not Done']);
            $table->enum('pss_r',['Done','Not Done']);
            $table->enum('pss_c',['Done','Not Done']);
            $table->enum('hts_r',['Done','Not Done']);
            $table->enum('hts_c',['Done','Not Done']);
            $table->enum('sti_screening_r',['Done','Not Done']);
            $table->enum('sti_screening_c',['Done','Not Done']);
            $table->enum('sti_treatment_r',['Done','Not Done']);
            $table->enum('sti_treatment_c',['Done','Not Done']);
            $table->enum('legal_aid_r',['Done','Not Done']);
            $table->enum('legal_aid_c',['Done','Not Done']);
            $table->enum('pep_r',['Done','Not Done']);
            $table->enum('pep_c',['Done','Not Done']);
            $table->enum('pmtct_r',['Done','Not Done']);
            $table->enum('pmtct_c',['Done','Not Done']);
            $table->enum('fp_r',['Done','Not Done']);
            $table->enum('fp_c',['Done','Not Done']);
            $table->enum('others_r',['Done','Not Done']);
            $table->enum('others_c',['Done','Not Done']);
            $table->string('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_y_p__h_c_b_f_s');
    }
};
