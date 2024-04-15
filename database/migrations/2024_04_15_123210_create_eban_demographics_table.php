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
        Schema::create('eban_demographics', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('unique_identifier')->unique();
            $table->string('sno');
            $table->string('month');
            $table->integer('year');
            $table->string('region');
            $table->string('counties');
            $table->string('sub_county');
            $table->string('ward');
            $table->string('site_name');
            $table->string('implementing_partner');
            $table->string('facilitator_i');
            $table->string('facilitator_ii')->nullable();
            $table->string('group_no_name')->nullable();
            $table->string('start_date');
            $table->string('end_date');
            $table->string('couple_code');
            $table->string('participant_name');
            $table->integer('age')->nullable();
            $table->string('sex');
            $table->string('hiv_status');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eban_demographics');
    }
};
