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
        Schema::create('monthly_highlights', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('region');
            $table->date('start_date');
            $table->date('end_date');
            $table->mediumText('key_highlights');
            $table->mediumText('key_action_points');
            $table->mediumText('hq_support')->nullable();
            $table->mediumText('next_month_plans')->nullable();
            $table->mediumText('supervisor_comments')->nullable();
            $table->string('status')->default('draft');
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_highlights');
    }
};
