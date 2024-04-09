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
        Schema::create('p_m_t_c_t_s', function (Blueprint $table) {
            $table->id();
            $table->integer('sno');
            $table->integer('user_id');
            $table->string('month');
            $table->text('year');
            $table->string('region');
            $table->string('sr_name');
            $table->string('county')->nullable();
            $table->string('sub_county')->nullable();
            $table->string('care_facility')->nullable();
            $table->string('name')->nullable();
            $table->string('mother_ccc_no')->nullable();
            $table->text('dob')->nullable();
            $table->string('age')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('lactating')->nullable();
            $table->string('pregnant')->nullable();
            $table->text('no_of_anc_visits')->nullable();
            $table->string('delivery_at_facility')->nullable();
            $table->string('hei_id')->nullable();
            $table->text('hei_dob')->nullable();
            $table->string('age_in_months')->nullable();
            $table->string('sex')->nullable();
            $table->string('date_of_enrolment')->nullable();
            $table->string('received_prophylaxis_at_6_wks')->nullable();
            $table->string('dna_pcr_status_at_6_8_wks')->nullable();
            $table->string('dna_pcr_status_at_6_months')->nullable();
            $table->text('dna_pcr_status_at_12_months')->nullable();
            $table->text('test_result_of_ab_at_18_months')->nullable();
            $table->string('confirm_test_results')->nullable();
            $table->string('linked_facility')->nullable();
            $table->string('hei_ccc_number')->nullable();
            $table->string('final_outcome')->nullable();
            $table->string('hei_remarks')->nullable();
            $table->text('reached_by_expert_mother')->nullable();
            $table->string('attended_pssg')->nullable();
            $table->text('art_status')->nullable();
            $table->string('due_for_vl')->nullable();
            $table->string('vl_done')->nullable();
            $table->string('received_vl_result')->nullable();
            $table->text('vl_copies')->nullable();
            $table->text('screened_for_sti')->nullable();
            $table->string('diagonsed_for_sti')->nullable();
            $table->text('treated_for_sti')->nullable();
            $table->text('cervical_cancer_screening')->nullable();
            $table->text('cacx_results')->nullable();
            $table->text('treated_for_cacx')->nullable();
            $table->string('reached_with_fp_information')->nullable();
            $table->string('screened_for_pregnancy_intention')->nullable();
            $table->string('currently_on_fp')->nullable();
            $table->text('screened_for_tb')->nullable();
            $table->text('tb_diagnosis')->nullable();
            $table->text('reffered_for_tb_treatment')->nullable();
            $table->string('experienced_violence')->nullable();
            $table->string('received_post_violence_support')->nullable();
            $table->string('remarks_comments')->nullable();
            $table->string('unique_identifier')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_m_t_c_t_s');
    }
};
