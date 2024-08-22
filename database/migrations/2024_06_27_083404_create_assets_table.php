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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('asset_tag_id');
            $table->string('description');
            $table->string('serial_no');
            $table->date('purchase_date');
            $table->string('cost');
            $table->string('purchased_from');
            $table->string('brand');
            $table->string('model');
            $table->string('category');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
