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
        Schema::create('group_user', function (Blueprint $table) {
           
            $table->unsignedBigInteger('groupId');
            $table->unsignedBigInteger('userId');
            $table->unsignedInteger('createBy')->nullable();
            $table->unsignedInteger('updateBy')->nullable();
            $table->timestamps();

            $table->foreign('groupId')->references('id')->on('group')->cascadeOnDelete();
            $table->foreign('userId')->references('id')->on('user')->cascadeOnDelete();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_user');
    }
};
