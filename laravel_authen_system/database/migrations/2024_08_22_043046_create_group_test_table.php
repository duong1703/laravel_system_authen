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
        Schema::create('group_test', function (Blueprint $table) {
            $table->unsignedBigInteger('groupId');
            $table->unsignedInteger('testId');
            $table->unsignedInteger('createBy');
            $table->unsignedInteger('updateBy');
            $table->timestamps();

            $table->primary(['groupId', 'testId']); 

            $table->foreign('groupId')->references('id')->on('group')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_test');
    }
};
