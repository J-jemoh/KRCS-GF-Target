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
        Schema::create('v_p__d_c_s', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('unique_identifier')->unique();
            $table->string('sno');
            $table->string('month');
            $table->string('year');
            $table->string('implementing_partner');
            $table->text('region');
            $table->string('county');
            $table->text('subcounty');
            $table->string('peer_educator');
            $table->string('peer_name');
            $table->text('facility');
            $table->string('ward');
            $table->string('disability');
            $table->enum('sex',['Male','Female']);
            $table->integer('age');
            $table->string('phone_no')->nullable();
            $table->string('first_contact_date');
            $table->string('enrol_date');
            $table->text('hiv_status_at_enrollment');
            $table->string('received_health_education')->nullable();
            $table->string('tested_hiv')->nullable();
            $table->text('frequency_of_hiv_test')->nullable();
            $table->text('hiv_status')->nullable();
            $table->string('started_on_art')->nullable();
            $table->string('currently_on_art')->nullable();
            $table->text('due_for_vl')->nullable();
            $table->string('received_vl_test')->nullable();
            $table->text('vl_copies')->nullable();
            $table->string('screened_for_tb')->nullable();
            $table->string('diagnosed_with_tb')->nullable();
            $table->string('started_tb_treatment')->nullable();
            $table->string('screened_for_sti')->nullable();
            $table->string('diagnosed_with_sti')->nullable();
            $table->string('treated_for_sti')->nullable();
            $table->string('initiated_on_prep')->nullable();
            $table->string('currently_on_prep')->nullable();
            $table->text('issued_with_condoms')->nullable();
            $table->string('tttended_of_pssg')->nullable();
            $table->string('reached_with_eban')->nullable();
            $table->string('experienced_violence')->nullable();
            $table->string('received_post_violence_support')->nullable();
            $table->string('programme_status')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_p__d_c_s');
    }
};
