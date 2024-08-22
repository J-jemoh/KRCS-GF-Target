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
        Schema::create('assets_issueds', function (Blueprint $table) {
            $table->id();
            $table->integer('asset_id');
            $table->integer('user_id');
            $table->string('region');
            $table->string('sr_name')->nullable();
            $table->string('person_issued');
            $table->string('person_contact');
            $table->date('issue_date');
            $table->date('return_date')->nullable();
            $table->string('return_codition')->nullable();
            $table->string('returned_by')->nullable();
            $table->string('condition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets_issueds');
    }
};
