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
        Schema::create('a_y_p_mentorships', function (Blueprint $table) {
            $table->id();
            $table->string('sno');
            $table->integer('user_id');
            $table->string('unique_id')->unique();
            $table->string('month');
            $table->string('year');
            $table->string('region');
            $table->string('counties');
            $table->string('subcounty')->nullable();
            $table->string('ward')->nullable();
            $table->string('venue')->nullable();
            $table->string('implementingpartner')->nullable();
            $table->string('nementor1')->nullable();
            $table->string('nementor2')->nullable();
            $table->string('cohortnumber')->nullable();
            $table->string('menteename')->nullable();
            $table->text('dob')->nullable();
            $table->integer('age')->nullable();
            $table->enum('sex', ['F', 'M']);
            $table->text('phonenumber')->nullable();
            $table->string('village')->nullable();
            $table->text('uniqueidentifier')->nullable();
            $table->text('start_date')->nullable();
            $table->text('end_date')->nullable();
            $table->string('session1')->nullable();
            $table->string('session2')->nullable();
            $table->string('session3')->nullable();
            $table->string('session4')->nullable();
            $table->string('session5')->nullable();
            $table->enum('makeup_session',['Done','Not Done']);
            $table->enum('complete_session',['Complete sessions','Not Complete']);
            $table->string('services_referred')->nullable();
            $table->string('services_accessed')->nullable();
            $table->string('attended_outreach')->nullable();
            $table->enum('attended_ebi',['Yes','No']);
            $table->mediumText('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_y_p_mentorships');
    }
};
