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
        Schema::create('department_updates', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('department');
            $table->string('week');
            $table->date('start_date');
            $table->date('end_date');
            $table->mediumText('achievements');
            $table->mediumText('work_plan');
            $table->mediumText('key_risks')->nullable();
            $table->mediumText('comments')->nullable();
            $table->mediumText('matters_arising')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_updates');
    }
};
