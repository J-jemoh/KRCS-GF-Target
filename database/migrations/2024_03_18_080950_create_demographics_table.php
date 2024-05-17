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
        Schema::create('demographics', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('sno');
            $table->string('month');
            $table->integer('year');
            $table->text('region');
            $table->string('county');
            $table->string('sr_name');
            $table->text('kp_name');
            $table->string('hotspot');
            $table->string('hotspot_typology');
            $table->string('other_hotspot');
            $table->string('subcounty');
            $table->string('ward');
            $table->string('kp_phone')->nullable();
            $table->string('kp_type');
            $table->string('uic');
            $table->unsignedInteger('age')->nullable();
            $table->string('yob');
            $table->enum('sex',['Male','Female']);
            $table->string('first_contact_date');
            $table->string('enrol_date');
            $table->text('hiv_status_enrol');
            $table->string('peer_educator');
            $table->text('peer_educator_code');
            $table->timestamps();
            $table->string('unique_identifier')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demographics');
    }
};
