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
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->string("module");
            $table->string("quater");
            $table->string("year");
            $table->string("reqion");
            $table->string("sr");
            $table->string("county");
            $table->string("defined_q1")->nullable();
            $table->string("defined_q2")->nullable();
            $table->string("defined_target")->nullable();
            $table->string("defined_sem")->nullable();
            $table->string("defined_performance")->nullable();
            $table->string("hts_q1")->nullable();
            $table->string("hts_q2")->nullable();
            $table->string("hts_target")->nullable();
            $table->string("hts_sem")->nullable();
            $table->string("hts_performance")->nullable();
            $table->string("prep_q1")->nullable();
            $table->string("prep_q2")->nullable();
            $table->string("prep_target")->nullable();
            $table->string("prep_total")->nullable();
            $table->string("prep_performance")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('targets');
    }
};
