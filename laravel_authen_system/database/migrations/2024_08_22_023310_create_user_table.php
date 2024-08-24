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
        Schema::create('user', function (Blueprint $table) {
            $table->id(); 
            $table->string('userName', 100)->index();
            $table->string('userPassword', 64);
            $table->string('userEmail', 255);
            $table->string('userFirstName', 100);
            $table->string('userLastName', 100);
            $table->string('userMiddleName', 100);
            $table->tinyInteger('userGender');
            $table->bigInteger('userBirthday');
            $table->bigInteger('userJoinDate');
            $table->bigInteger('userLoginDate');
            $table->bigInteger('userExpireDate');
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
        Schema::dropIfExists('user');
    }
};
