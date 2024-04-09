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
        Schema::create('a_y_p_s', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('sno');
            $table->string('month');
            $table->integer('year');
            $table->text('region');
            $table->text('sr_name');
            $table->string('county');
            $table->text('subcounty');
            $table->string('ward');
            $table->string('reporting_month');
            $table->string('outreach_date');
            $table->text('outreach_venue');
            $table->text('pe_name');
            $table->text('peer_name');
            $table->string('dob');
            $table->integer('age');
            $table->string('sex');
            $table->string('disabled');
            $table->text('disability_type');
            $table->text('phone');
            $table->string('attended_ebi');
            $table->text('attended_outreach');
            $table->string('provided_health_edu');
            $table->string('provided_srh_info');
            $table->string('counseled_safe_behavior');
            $table->text('family_planning_info');
            $table->string('offered_fp_services');
            $table->text('risk_assessment');
            $table->string('iec_material_offered');
            $table->string('tested_hiv');
            $table->text('hiv_results');
            $table->text('art_initiated');
            $table->string('art_hf_linked_to');
            $table->string('ccc_number');
            $table->string('linked_to_cats');
            $table->text('sti_screening');
            $table->string('treated_sti');
            $table->string('tb_screened');
            $table->text('referred_tb_treatment');
            $table->string('screened_sgbv');
            $table->text('referred_sgbv_tx');
            $table->string('cervical_cancer_screening');
            $table->text('referred_cancer_treatment');
            $table->string('offered_pep');
            $table->text('offered_prep');
            $table->string('offered_condoms');
            $table->text('num_condoms_offered');
            $table->string('post_rape_care_services');
            $table->text('post_abortion_care');
            $table->string('treated_other_ailments');
            $table->text('if_yes_specify');
            $table->string('unique_identifier')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_y_p_s');
    }
};
