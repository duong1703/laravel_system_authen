<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('group', function (Blueprint $table) {
            $table->id(); 
            $table->string('goupName', 100)->index();
            $table->string('groupDescription', 255);
            $table->tinyInteger('accessSite');
            $table->tinyInteger('accessAdmin');
            $table->tinyInteger('accessTestManager');
            $table->tinyInteger('accessGradingSystem');
            $table->tinyInteger('accessQuestionBank');
            $table->tinyInteger('accessSubjects');
            $table->tinyInteger('accessGroups');
            $table->tinyInteger('accessUsers');
            $table->unsignedInteger('createBy');
            $table->unsignedInteger('updateBy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group');
    }
};
