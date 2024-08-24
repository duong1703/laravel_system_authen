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
        Schema::create('subject', function (Blueprint $table) {
            $table->id();
            $table->string('subjectName', 255);
            $table->string('subjectDescription', 255);
            $table->unsignedBigInteger('subjectParentId');
            $table->unsignedInteger('createBy');
            $table->unsignedInteger('updateBy');
            $table->timestamps();

            $table->foreign('subjectParentId')->references('id')->on('subject')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject');
    }
};
