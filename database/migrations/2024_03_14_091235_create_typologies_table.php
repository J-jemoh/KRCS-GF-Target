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
        Schema::create('typologies', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('sno');
            $table->text('peer_educator_code');
            $table->enum('received_peer_education',['Yes','No'])->nullable();
            $table->enum('clinical_services',['Yes','No'])->nullable();
            $table->enum('hiv_tested',['Yes','No'])->nullable();
            $table->string('hts_service_point')->nullable();
            $table->text('hiv_test_freq')->nullable();
            $table->string('hiv_status')->nullable();
            $table->string('self_test_hiv')->nullable();
            $table->text('pre_art')->nullable();
            $table->string('art_started')->nullable();
            $table->string('currently_art')->nullable();
            $table->text('current_facility_care')->nullable();
            $table->string('hiv_care_outcome')->nullable();
            $table->string('art_outcome')->nullable();
            $table->text('due_vl')->nullable();
            $table->string('vl_done')->nullable();
            $table->string('vl_result_received')->nullable();
            $table->text('att_vl_suppression')->nullable();
            $table->string('tb_screened')->nullable();
            $table->string('tb_diagonised')->nullable();
            $table->text('tb_treatment_started')->nullable();
            $table->string('hiv_exposure_72hr')->nullable();
            $table->string('pep_72')->nullable();
            $table->string('completed_pep')->nullable();
            $table->text('condom_nmbr_reqr')->nullable();
            $table->string('condom_distributed_nmbr')->nullable();
            $table->string('condom_prov_as_per_need')->nullable();
            $table->text('lubricant_req_nbr')->nullable();
            $table->string('lubricant_distr_nbr')->nullable();
            $table->string('lubricant_prov_per_need')->nullable();
            $table->text('nssp_nmbr')->nullable();
            $table->string('nssp_distributed_nbr')->nullable();
            $table->string('received_nssp_need')->nullable();
            $table->text('hepc_screened')->nullable();
            $table->string('hepc_status')->nullable();
            $table->string('hepc_treated')->nullable();
            $table->text('hepb_screening')->nullable();
            $table->string('hepb_status')->nullable();
            $table->string('on_hepb_treatment')->nullable();
            $table->text('hepb_vaccination')->nullable();
            $table->string('sti_screened')->nullable();
            $table->string('sti_diagnosied')->nullable();
            $table->text('sti_treated')->nullable();
            $table->string('drug_abuse_screened')->nullable();
            $table->string('prep_initated')->nullable();
            $table->text('on_prep')->nullable();
            $table->string('modern_fp_services')->nullable();
            $table->enum('rssh',['Yes','No'])->nullable();
            $table->text('ebi')->nullable();
            $table->string('exp_violence')->nullable();
            $table->string('post_violence_support')->nullable();
            $table->text('program_status')->nullable();
            $table->string('tca')->nullable();
            $table->timestamps();
            $table->string('month');
            $table->integer('year');
            $table->text('region');
            $table->enum('kp_type',['PWID','MSM','TG','TRANS WOAMAN','TRANS MAN','FSW','FISHER FOLK','TRUCKERS']);
            $table->string('unique_identifier')->unique();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('typologies');
    }
};
