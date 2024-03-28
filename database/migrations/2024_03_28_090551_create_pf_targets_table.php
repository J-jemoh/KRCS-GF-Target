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
        Schema::create('pf_targets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('sno');
            $table->mediumText('coverage_indicator');
            $table->integer('baseline_dec');
            $table->integer('june_target')->nullable();
            $table->integer('period1');
            $table->integer('period2');
            $table->integer('period3');
            $table->integer('period4');
            $table->integer('period5');
            $table->integer('period6');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pf_targets');
    }
};
