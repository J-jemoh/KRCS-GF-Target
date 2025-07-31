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
        Schema::create('management_actions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('duration');
            $table->string('region');
            $table->string('category');
            $table->string('sr_name');
            $table->mediumText('key_issues');
            $table->mediumText('root_cause');
            $table->mediumText('mitigation_action');
            $table->date('date');
            $table->mediumText('sr_response');
            $table->string('status_update');
            $table->text('reference_documents')->nullable();
            $table->text('sr_attachmemts')->nullable();
            $table->text('pr_attachments')->nullable();
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
        Schema::dropIfExists('management_actions');
    }
};
