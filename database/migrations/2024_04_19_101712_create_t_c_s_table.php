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
        Schema::create('t_c_s', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('unique_identifier')->unique();
            $table->string('sno');
            $table->string('month');
            $table->string('year');
            $table->string('region');
            $table->string('sr');
            $table->string('county');
            $table->string('sub_county');
            $table->string('health_facility');
            $table->string('community_tracing_focal_person');
            $table->string('ccc_number');
            $table->string('dob');
            $table->integer('age');
            $table->enum('sex', ['F', 'M']);
            $table->enum('pregnant_lactating', ['Yes', 'No','NA']);
            $table->text('missed_appointment_date')->nullable();
            $table->text('date_listed_as_defaulter')->nullable();
            $table->text('date_of_community_tracing')->nullable();
            $table->string('tracing_outcome')->nullable();
            $table->text('date_of_community_tracing_2')->nullable();
            $table->string('tracing_outcome_2')->nullable();
            $table->text('date_of_community_tracing_3')->nullable();
            $table->string('tracing_outcome_3')->nullable();
            $table->string('linked_facility')->nullable();
            $table->text('date_received_at_linked_facility')->nullable();
            $table->mediumText('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_c_s');
    }
};
